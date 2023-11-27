<?php

namespace App\Http\Controllers;

use App\Models\ImageProduct;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic;

class ImageProductController extends Controller
{
    public function convertWebp(){
        $images = ImageProduct::all();

        foreach($images as $img){
            $src = public_path("img/products/$img->photo");
            if(file_exists($src)){
                $image = file_get_contents($src);
                $imageConvert = ImageManagerStatic::make($image);
                $imageName = date('mdYHis') . uniqid() . '.' . 'webp';
                $imageConvert->save(public_path('img/products/'. $imageName));
                $img->update(['photo' => $imageName]);
            }

        }
    }
}
