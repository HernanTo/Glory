<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\TypeContent;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pictures = Content::all();
        return view('cms.index', ['pictures'=> $pictures]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('img')){
            $pictureConvert = ImageManagerStatic::make($request->img);
            $image_name = date('mdYHis') . uniqid() . '.' . 'webp';
            $pictureConvert->save(public_path('img/content/'. $image_name));
            Content::create([
                'id_type' => 1,
                'path' => $image_name
            ]);
            return redirect()->route('cms');
        }else{
            return \redirect()->route('cms')->withErrors('No se subieron fotos');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Content::find($request->id)->delete();
        return redirect()->route('cms');
    }
}
