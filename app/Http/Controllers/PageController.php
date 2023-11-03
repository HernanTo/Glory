<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $latestProducts = Product::where('is_active', 1)->take(5)->orderby('created_at', 'desc')->get();

        $category = Category::where('is_active', 1)->where('name', 'motor')->get()->first();
        $productsCategory = $category->products;

        return view('ecommerce.index', [
            'latestProducts' => $latestProducts,
            'productsCategory' => $productsCategory,
        ]);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->get();

        if(count($product)<= 0){
            abort(404);
        }

        $product = $product->first();

        $categoryProduct = $product->categories()->first();
        $category = Category::where('is_active', 1)->where('name', $categoryProduct->name)->get()->first();
        $similarProducts = $category->products->where('slug', '!=', $slug)->take(3);

        return view('ecommerce.producto', [
            'product' => $product,
            'similarProducts' => $similarProducts,
        ]);
    }

    public function category($nameCategory){
        $category = Category::where('is_active', 1)->where('name', $nameCategory)->get()->first();
        if($category){
            $productsCategory = $category->products;
        }else{
            abort(404);
        }

        return view('ecommerce.categoria', [
            'productsCategory' => $productsCategory,
            'category' => $category,
        ]);
    }

    public function catalogo(){
        $categories = Category::where('is_active', 1)->get();

        return view('ecommerce.catalogo', ['categories' => $categories]);
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
