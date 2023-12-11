<?php

namespace App\Http\Controllers;

use App\Http\Requests\changePasswordRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = auth()->user();

        return view('settings.index', ['profile' => $profile]);

    }

    public function category(){
        $categories = Category::where('is_active', 1)->get();

        return view('settings.categoria', ['categories' => $categories]);
    }
    public function categoryDes(){
        $categories = Category::where('is_active', 0)->get();

        return view('settings.categoriaDes', ['categories' => $categories]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = auth()->user();
        return view('ecommerce.profile.index', ['profile' => $user]);
    }

    public function edit(){
        $user = auth()->user();
        return view('ecommerce.profile.edit', ['profile' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $profile = User::find(auth()->user()->id);

        if(auth()->user()->can('getInto.administration')){
            $redirect = redirect()->route('settings');

        }elseif(auth()->user()->can('getIntoViews.User')){
            $redirect = redirect()->route('profile.edit');
        }

        $rules = [
            'ft_name' => 'required|string',
            'imgeProfile' => 'mimes:jpeg,png,jpg|max:5120',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $redirect->withErrors($validator)->withInput();
        }

        $deleteImages = true;
        $image_name = 'default.png';

        if($request->hasFile('imgeProfile')){
            if($profile->profile_photo_path == 'default.png' || $profile->profile_photo_path == null){
                $deleteImages = false;
            }else{
                $deleteImages = true;
            }

            $image_name = time() . '.' . $request->imgeProfile->extension();
            $request->imgeProfile->storeAs('/', $image_name, 'users');
        }

        if($deleteImages && $profile->profile_photo_path != 'default.png'){
            if (file_exists(public_path('img/profileImages/' . $profile->profile_photo_path))) {
                unlink(public_path('img/profileImages/' . $profile->profile_photo_path));
            }
        }


        $profile->update([
            'ft_name' => $request->input('ft_name'),
            'sc_name' => $request->input('sc_name'),
            'fi_lastname' => $request->input('fi_lastname'),
            'sc_lastname' => $request->input('sc_lastname'),
            'address' => $request->input('address'),
            'profile_photo_path' => $image_name
        ]);

        return $redirect;
    }

    public function updatePassword(changePasswordRequest $request){
        $user = User::find(auth()->user()->id);
        if(auth()->user()->can('getInto.administration')){
            $redirect = redirect()->route('settings');

        }elseif(auth()->user()->can('getIntoViews.User')){
            $redirect = redirect()->route('profile.edit');
        }

        if(Hash::check($request->password_currently, $user->password)){
            $user->update([
                'password' => Hash::make($request->new_password),
                'pass_change' => 1,
            ]);
            return $redirect;

        }else{
            return back()->withErrors(['msg' => 'La contraseña ingresada, no coincide con la registrada']);
        }
    }
}
