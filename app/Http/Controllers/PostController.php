<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postsR = Blog::where('is_active', 1)->orderby('created_at', 'desc')->take(6)->get();
        $posts = Blog::where('is_active', 1)->orderby('created_at', 'desc')->simplePaginate(6);

        return view('blog.guest.index', ['posts' => $posts, 'postsR' => $postsR]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post =  Blog::where('slug', $slug)->get()->first();
        $postsR = Blog::where('is_active', 1)->orderby('created_at', 'desc')->take(6)->get();
        if(!$post){
            abort(404);
        }

        return \view('blog.guest.post', ['post' => $post, 'postsR' => $postsR]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
