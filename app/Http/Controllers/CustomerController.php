<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($cc)
    {
        // echo $cc
        $user = Customer::where('cc', $cc)->get();
        if ($user->count() <= 0){
            abort(404);
        }

        return view('clientes.cliente', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($cc)
    {
        $user = Customer::where('cc', $cc)->get();

        if ($user->count() <= 0){
            abort(404);
        }

        return view('clientes.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $item)
    {
        $rules = [
            'ft_name' => 'required|string',
            'imgeProfile' => 'mimes:jpeg,png,jpg|max:5120',
        ];

        if ($request->has('cc') && $request->input('cc') != $item->cc) {
            $rules['cc'] = 'required|unique:customers,cc';
        }
        if ($request->has('phone') && $request->input('phone') != $item->phone_number) {
            $rules['phone'] = 'required|numeric|unique:customers,phone_number';
        }

        if ($request->has('email') && $request->input('email') != $item->email) {
            $rules['email'] = 'nullable|email|unique:customers';
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
            $request->imgeProfile->storeAs('/', $image_name, 'users');
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
            'profile_photo_path' => $image_name,
            'modelo' => $request->input('modelo'),
            'placa' => $request->input('placa'),
        ]);

        return redirect()->route('usuarios');
    }
}
