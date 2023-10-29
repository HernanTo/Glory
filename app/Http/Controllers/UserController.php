<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Stmt\Else_;
use Spatie\Permission\Models\Role;
use Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->can('see.admin')){
            $users = User::where('is_active', '1')
                            ->where('id', '!=', Auth()->user()->id)
                            ->get();

        }elseif(auth()->user()->can('see.manager')){
            $users = User::role(['Gerente', 'Servicios', 'Vendedor', 'Cliente Web'])
                    ->where('is_active', '1')
                    ->where('id', '!=', Auth()->user()->id)
                    ->get();

        }elseif(auth()->user()->can('see.workers')){
            $users = User::role(['Servicios', 'Vendedor', 'Cliente Web'])
                    ->where('is_active', '1')
                    ->where('id', '!=', Auth()->user()->id)
                    ->get();
        }else{
            $users = User::role(['Cliente Web'])
                        ->where('is_active', '1')
                        ->where('id', '!=', Auth()->user()->id)
                        ->get();
        }

        $customers = Customer::where('is_active', '1')->get();


        return view('usuarios.index', ['users' => $users, 'customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->can('create.admin')){
            $roles = Role::where("name", '!=', 'Cliente Web')->get();

        }elseif(auth()->user()->can('create.manager')){
            $roles = Role::where("name", '!=', 'Cliente Web')
                            ->where("name", '!=', 'Administrador')
                            ->get();

        }elseif(auth()->user()->can('create.workers')){
            $roles = Role::where("name", '!=', 'Cliente Web')
                            ->where("name", '!=', 'Administrador')
                            ->where("name", '!=', 'Gerente')
                            ->get();
        }else{
            $roles = Role::where("name", '!=', 'Cliente Web')
                            ->where("name", '!=', 'Administrador')
                            ->where("name", '!=', 'Gerente')
                            ->where("name", '!=', 'Servicios')
                            ->where("name", '!=', 'Vendedor')
                            ->get();

        }
        return view('usuarios.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newUser = null;

        $data = [
            'cc' => $request->cc,
            'ft_name' => $request->ft_name,
            'sc_name' => $request->sc_name,
            'fi_lastname' => $request->fi_lastname,
            'sc_lastname' => $request ->sc_lastname,
            'phone_number' => $request ->phone,
            'address' => $request ->address,
            'email' => $request ->email,
            'profile_photo_path' => 'default.png',
            'is_active' => 1,
        ];

        if($request->role == 'Cliente'){
            $validator = Validator::make($request->all(), [
                'cc' => 'required|unique:customers',
                'ft_name' => 'required|string',
                'email' => 'nullable|email|unique:customers',
                'phone' => 'required|numeric|unique:customers,phone_number',
                'role' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('usuarios/add')
                ->withErrors($validator)
                ->withInput();
            }else{
                Customer::create($data);
                $newUser = true;
            }

        }else{
            $validator = Validator::make($request->all(), [
                'cc' => 'required|unique:users',
                'ft_name' => 'required|string',
                'email' => 'nullable|email|unique:users',
                'phone' => 'required|numeric|unique:users,phone_number',
                'role' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('usuarios/add')
                ->withErrors($validator)
                ->withInput();

            }else{
               $user = User::create([
                    'cc' => $request->cc,
                    'ft_name' => $request->ft_name,
                    'sc_name' => $request->sc_name,
                    'fi_lastname' => $request->fi_lastname,
                    'sc_lastname' => $request ->sc_lastname,
                    'phone_number' => $request ->phone,
                    'address' => $request ->address,
                    'email' => $request ->email,
                    'password' => Hash::make($request->cc),
                    'pass_change' => '0',
                    'profile_photo_path' => 'default.png',
                    'is_active' => 1,
                ]);
                $newUser = true;

                $user->assignRole($request->role);
            }
        }
        return redirect()->route('usuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cc)
    {
        $userM = User::where('cc', $cc)->get()->first();
        $user = User::where('cc', $cc)->get();

        $rolUser = $userM->getRoleNames()->first();

        if ($user->count() <= 0){
            abort(404);
        }

        if($rolUser == 'Administrador' && !auth()->user()->can('see.admin')){
            abort(404);

        }elseif($rolUser == 'Gerente' && !auth()->user()->can('see.manager')){
            abort(404);

        }elseif(($rolUser == 'Vendedor' || $rolUser == 'Servicios') &&  !auth()->user()->can('see.workers')){
            abort(404);
        }

        return view('usuarios.usuario', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cc)
    {
        $user = User::where('cc', $cc)->get();

        $userM = User::where('cc', $cc)->get()->first();

        $roles = Role::where("name", '!=', 'Cliente Web')
                ->where("name", '!=', 'Cliente')
                ->get();

        if ($user->count() <= 0){
            abort(404);
        }

        $rolUser = $userM->getRoleNames()->first();

        if ($user->count() <= 0){
            abort(404);
        }

        if($rolUser == 'Administrador' && !auth()->user()->can('see.admin')){
            abort(404);

        }elseif($rolUser == 'Gerente' && !auth()->user()->can('see.manager')){
            abort(404);

        }elseif(($rolUser == 'Vendedor' || $rolUser == 'Servicios') &&  !auth()->user()->can('see.workers')){
            abort(404);
        }

        return view('usuarios.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $item)
    {
        $rules = [
            'ft_name' => 'required|string',
            'imgeProfile' => 'mimes:jpeg,png,jpg|max:5120',
        ];

        if ($request->has('cc') && $request->input('cc') != $item->cc) {
            $rules['cc'] = 'required|unique:users,cc';
        }
        if ($request->has('phone') && $request->input('phone') != $item->phone_number) {
            $rules['phone'] = 'required|numeric|unique:users,phone_number';
        }

        if ($request->has('email') && $request->input('email') != $item->email) {
            $rules['email'] = 'nullable|email|unique:users';
        }
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect("usuarios/$item->cc/edit")
            ->withErrors($validator)
            ->withInput();
        }

        $deleteImages = true;
        $image_name = 'default.png';

        if($request->hasFile('imgeProfile')){
            if($item->profile_photo_path == 'default.png' || $item->profile_photo_path == null){
                $deleteImages = false;
            }else{
                $deleteImages = true;
            }

            $image_name = time() . '.' . $request->imgeProfile->extension();
            $request->imgeProfile->move(public_path('img/profileImages'), $image_name);
        }

        if($deleteImages && $item->profile_photo_path != 'default.png'){
            if (file_exists(public_path('img/profileImages/' . $item->profile_photo_path))) {
                unlink(public_path('img/profileImages/' . $item->profile_photo_path));
            }
        }


        $item->update([
            'cc' => $request->input('cc'),
            'ft_name' => $request->input('ft_name'),
            'sc_name' => $request->input('sc_name'),
            'fi_lastname' => $request->input('fi_lastname'),
            'sc_lastname' => $request->input('sc_lastname'),
            'phone_number' => $request->input('phone'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'profile_photo_path' => $image_name
        ]);

        return redirect()->route('usuarios');

    }

    public function updateRole(Request $request, User $item){
        $currentRol = $item->getRoleNames()->first();

        $item->removeRole($currentRol);
        $item->assignRole($request->role);

        return redirect()->route('usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        if($request->type == 1){

            $userM = User::where('id', $request->id)->get()->first();
            $rolUser = $userM->getRoleNames()->first();

            if($rolUser == 'Administrador' && !auth()->user()->can('delete.admin')){
                abort(404);

            }elseif($rolUser == 'Gerente' && !auth()->user()->can('delete.manager')){
                abort(404);

            }elseif(($rolUser == 'Vendedor' || $rolUser == 'Servicios') &&  !auth()->user()->can('delete.workers')){
                abort(404);
            }

            $user = User::where('id',$request->id)->update(['is_active' => false]);

        }elseif($request->type == 2){
            $user = Customer::where('id',$request->id)->update(['is_active' => false]);
        }

        return redirect()->route('usuarios');
    }
}
