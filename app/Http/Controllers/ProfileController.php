<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(User $profile)
    {
        //
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

        $rules = [
            'ft_name' => 'required|string',
            'imgeProfile' => 'mimes:jpeg,png,jpg|max:5120',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('settings')
            ->withErrors($validator)
            ->withInput();
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

        return redirect()->route('settings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $profile)
    {
        //
    }
}
