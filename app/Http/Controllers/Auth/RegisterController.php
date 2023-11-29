<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::VERIFICATION;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'cc' => 'required|unique:users',
            'ft_name' => 'required|string',
            'ft_lastname' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|unique:users,phone_number',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'cc' => $data['cc'],
            'ft_name' => $data['ft_name'],
            'sc_name' => $data['sc_name'],
            'fi_lastname' => $data['ft_lastname'],
            'sc_lastname' => $data['sc_lastname'],
            'phone_number' => $data['phone'],
            'address' => $data['address'],
            'email' => $data['email'],
            'password' => Hash::make($data['cc']),
            'pass_change' => '0',
            'profile_photo_path' => 'default.png',
            'is_active' => 1,
        ]);

        $user->assignRole('Cliente Web');

        return $user;
    }
}
