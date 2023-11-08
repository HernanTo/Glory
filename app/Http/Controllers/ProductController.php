<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\ImageProduct;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Echo_;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('is_active', '1')->get();

        return view('productos.administration.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('is_active', 1)->get();

        return view('productos.administration.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        $product = Product::create([
            'barcode' => $request->barcode,
            'num_repuesto' => $request->num_repuesto,
            'name' => $request->name,
            'price' => str_replace(',', '', $request->price),
            'cost' => str_replace(',', '', $request->cost),
            'stock' => $request->stock,
            'description' => $request->desc,
            'min_stock' => $request->min_stock,
            'available' => $request->available,
            'is_active' => true,
        ]);

        foreach($request->category as $category){
            $product->categories()->attach($category);
        }

        if(is_array($request->pictures_product) && count($request->pictures_product) > 0 && $request->hasFile('pictures_product')){
            foreach($request->pictures_product as $picture){
                $image_name = date('mdYHis') . uniqid() . '.' . $picture->extension();
                $picture->storeAs('/', $image_name, 'products');
                $image = ImageProduct::create(['photo' => $image_name]);
                $product->images()->save($image);
            }
        }
        return redirect()->route('productos.administration');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->get();

        if(count($product)<= 0){
            abort(404);
        }

        $product = $product->first();

        return view('productos.administration.producto', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $product = Product::where('slug', $slug)->get();

        if(count($product)<= 0){
            abort(404);
        }

        $product = $product->first();
        $images = $product->images;

        $categories = Category::where('is_active', 1)->get();

        return view('productos.administration.edit', ['product' => $product, 'categories' => $categories, 'images' => $images]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'cost' => 'required',
            'stock' => 'required|numeric',
            'min_stock' => 'required|numeric',
            'available' => 'required|numeric',
        ];

        if ($request->has('num_repuesto') && $request->input('num_repuesto') != $product->num_repuesto) {
            $rules['num_repuesto'] = 'required|numeric|unique:products,num_repuesto';
        }
        if ($request->has('barcode') && $request->input('barcode') != $product->barcode) {
            $rules['barcode'] = 'required|numeric|unique:products,barcode';
        }

        $validator = Validator::make($request->all(), $rules);

        // Delete photos
        if(is_array($request->deletedPhotos) && count($request->deletedPhotos) > 0){
            foreach($request->deletedPhotos as $photo){
                $MPhoto = ImageProduct::find($photo);
                if($MPhoto){
                    $MPhoto->delete();
                    if (file_exists(public_path('img/products/' . $MPhoto->photo))) {
                        unlink(public_path('img/products/' . $MPhoto->photo));
                    }
                }
            }
        }
        // update product
        $product->update([
            'barcode' => $request->barcode,
            'num_repuesto' => $request->num_repuesto,
            'name' => $request->name,
            'price' => str_replace(',', '', $request->price),
            'cost' => str_replace(',', '', $request->cost),
            'stock' => $request->stock,
            'description' => $request->desc,
            'min_stock' => $request->min_stock,
            'available' => $request->available,
        ]);

        // Add New images
        if(is_array($request->pictures_product) && count($request->pictures_product) > 0 && $request->hasFile('pictures_product')){
            foreach($request->pictures_product as $picture){
                $image_name = date('mdYHis') . uniqid() . '.' . $picture->extension();
                $picture->storeAs('/', $image_name, 'products');
                $image = ImageProduct::create(['photo' => $image_name]);
                $product->images()->save($image);
            }
        }

        return redirect()->route('productos.administration');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::where('id',$request->id)->update(['is_active' => false]);

        return redirect()->route('productos.administration');
    }
}
