<?php

namespace App\Http\Controllers;

use App\Http\Requests\createPostRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::where('is_active', 1)->get();
        return view('blog.administration.index', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.administration.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createPostRequest $request)
    {
        $image_name = '';

        if($request->hasFile('pictures')){
            $pictureConvert = ImageManagerStatic::make($request->pictures);
            $image_name = date('mdYHis') . uniqid() . '.' . 'webp';
            $pictureConvert->save(public_path("img/blog/". $image_name));
        }

        $post = Blog::create([
            'title' => $request->name,
            'body' => $request->desc,
            'path' => $image_name,
            'is_active' => 1,
        ]);

        return redirect()->route('blog.administration');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Blog::where('slug', $slug)->get()->first();

        return view('blog.administration.post', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Blog::where('slug', $slug)->get()->first();
        return view('blog.administration.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(createPostRequest $request, $slug)
    {
        $post = Blog:: where('slug', $slug)->get()->first();
        $image_name = '';
        if($request->hasFile('pictures')){
            if($post->path != ''){
                if(file_exists(public_path('img/blog/' . $post->path))){
                    unlink(public_path("img/blog/" . $post->path));
                }
            }

            $pictureConvert = ImageManagerStatic::make($request->pictures);
            $image_name = date('mdYHis') . uniqid() . '.' . 'webp';
            $pictureConvert->save(public_path("img/blog/". $image_name));
        }else{
            $image_name = $post->path;
        }

        $post = $post->update([
            'title' => $request->name,
            'body' => $request->desc,
            'path' => $image_name,
            'is_active' => 1,
        ]);

        return redirect()->route('blog.administration');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $post = Blog::find($request->id);
        $post->update(['is_active' => 0]);

        return redirect()->route('blog.administration');
    }
}
