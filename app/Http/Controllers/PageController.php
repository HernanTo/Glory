<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Content;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a landing page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $latestProducts = Product::where('is_active', 1)->take(10)->orderby('created_at', 'desc')->get();

        $products = Product::where('is_active', 1)->get()->random(10);
        $product = Product::where('is_active', 1)->get()->random(2)->first();

        $allCategories = Category::where('is_active', 1)->get();

        $posts = Blog::where('is_active', 1)->take(3)->orderby('created_at', 'desc')->get();

        $pictures = Content::all();

        return view('ecommerce.store.index', [
            'latestProducts' => $latestProducts,
            'allCategories' => $allCategories,
            'productsRandom' => $products,
            'productRandom' => $product,
            'posts' => $posts,
            'pictures'=> $pictures
        ]);
    }

    /**
     * Display one product
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('is_active', 1)->get();

        if(count($product)<= 0){
            abort(404);
        }

        $product = $product->first();

        $categoryProduct = $product->categories()->first();
        $category = Category::where('is_active', 1)->where('name', $categoryProduct->name)->get()->first();
        $similarProducts = $category->products->where('slug', '!=', $slug)->take(3);

        return view('ecommerce.store.producto', [
            'product' => $product,
            'similarProducts' => $similarProducts,
        ]);
    }

    // shows one category with its products
    public function category($nameCategory, Request $request){
        $category = Category::where('is_active', 1)->where('name', $nameCategory)->get()->first();
        if($category){
            $productsCategory = $category->products;

            if($request->order){
                if($request->order == 'asc'){
                    $productsCategory = $category->products->sortBy('price');
                }elseif($request->order == 'desc'){
                    $productsCategory = $category->products->sortByDesc('price');
                }else{
                    $productsCategory = $category->products;
                }
            }else{
                $productsCategory = $category->products;
            }

        }else{
            abort(404);
        }

        return view('ecommerce.store.categoria', [
            'productsCategory' => $productsCategory,
            'category' => $category,
        ]);
    }

    // show all products
    public function catalogo(){
        $Allcategories = Category::where('is_active', 1)->get();
        $categories = $Allcategories->filter(function ($category) {
            return $category->products->contains('is_active', true);
        });

        return view('ecommerce.store.catalogo', ['categories' => $categories, 'allCategories' => $Allcategories]);
    }


    // Show our stores
    public function stores(){
        return view('ecommerce.store.tiendas');
    }

    // search autocompletado
    public function search(Request $request){
        $term = $request->get('term');

        $products = Product::where('name', 'LIKE', '%'. $term .'%')->where('is_active', 1)->take(8)->get();
        $categories = Category::where('name', 'LIKE', '%'. $term .'%')->where('is_active', 1)->take(2)->get();
        $posts = Blog::where('title', 'LIKE', '%'. $term .'%')->where('is_active', 1)->take(3)->get();

        $data = [];
        foreach($products as $product){
            $data[] = [
                'label' => $product->name,
                'slug' => $product->slug,
                'type' => 'products',
            ];
        }
        foreach($categories as $category){
            $data[] = [
                'label' => $category->name,
                'type' => 'categories',
            ];
        }
        foreach($posts as $post){
            $data[] = [
                'label' => 'Blog: '. $post->title,
                'slug' => $post->slug,
                'type' => 'posts'
            ];
        }

        return $data;
    }

    // searching
    public function searchProducts(Request $request){
        if(strlen($request->p) <= 1){
            $products = collect();
            $productsQ = collect();
            $total = 0;
        }else{
            if($request->order){
                if($request->order == 'asc' || $request->order == 'desc'){
                    $products = Product::where('name', 'LIKE', '%'. $request->p .'%')
                                        ->where('is_active', 1)
                                        ->orderBy('price', $request->order)
                                        ->simplePaginate(10);
                }else{
                    $products = Product::where('name', 'LIKE', '%'. $request->p .'%')->where('is_active', 1)->simplePaginate(10);
                }
            }else{
                $products = Product::where('name', 'LIKE', '%'. $request->p .'%')->where('is_active', 1)->simplePaginate(10);
            }
            $productsQ = Product::where('name', 'LIKE', '%'. $request->p .'%')->where('is_active', 1)->get();
            $total = count($productsQ);
        }

        return view('ecommerce.store.searching', [
            'search' => $request->p,
            'products' => $products,
            'total' => $total
        ]);
    }

    public function profile(){
        if(auth()->user()->can('getInto.administration')){
            return redirect()->route('settings');

        }elseif(auth()->user()->can('getIntoViews.User')){
            return redirect()->route('profile');
        }
    }

    public function check(){
        if(!auth()->check()){
            return response()->json(['login' => false]);
        }else{
            return response()->json(['login' => true]);
        }
    }
}
