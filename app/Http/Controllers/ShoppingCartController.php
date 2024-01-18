<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShoppingCartController extends Controller
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
        $user = auth()->user();
        $cart = $user->shoppingCart;
        // Verifica que el usuario este ligado a un carrito, en caso de que no, lo creara
        if($cart == null){
            $cart = $this->storeCart($user);
        }

        $products = DB::table('shopping_carts_has_products')->where('id_cart', $cart->id)->get();
        $mix = collect();

        for ($i=0; $i < sizeof($products); $i++) {
            $mix->prepend([
                'id' => $cart->products[$i]->id,
                'slug' => $cart->products[$i]->slug,
                'name' => $cart->products[$i]->name,
                'nameFor' => $cart->products[$i]->nameFor,
                'stockCurrently' => $cart->products[$i]->stock,
                'priceU' => $products[$i]->price,
                'priceTodo' => $products[$i]->total_prices,
                'stockCart' => $products[$i]->stock,
                'img' => $cart->products[$i]->imagesMain,
            ]);
        }
        return view('ecommerce.carrito.index', ["cart" => $cart, 'products' => $cart->products, 'mix' => $mix]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $cart = $user->shoppingCart;
        // Verifica que el usuario este ligado a un carrito, en caso de que no, lo creara
        if($cart == null){
            $cart = $this->storeCart($user);
        }

        $product = Product::find($request->product);
        $tableShoppingProducts = DB::table('shopping_carts_has_products');
        // El accionar con base si el producto exite o no
        if($product){
            // Verifica si el producto ya habia sido agregado en otra ocasion

            $response = $tableShoppingProducts->where('id_cart', $cart->id)
                                                    ->where('id_product', $product->id)
                                                    ->get()
                                                    ->first();
            if(!$response){
                if($product->stock >= 1){
                    $tableShoppingProducts->insert([
                        'id_product' => $product->id,
                        'id_cart' => $cart->id,
                        'price' => $product->price,
                        'stock' => 1,
                        'total_prices' => $product->price,
                        'more_stock' => 0,
                        'quantity_with_stock' => 0
                    ]);
                }else{
                    $tableShoppingProducts->insert([
                        'id_product' => $product->id,
                        'id_cart' => $cart->id,
                        'price' => $product->price,
                        'stock' => 1,
                        'total_prices' => ($product->price / 2),
                        'more_stock' => 1,
                        'quantity_with_stock' => 1
                    ]);
                }

                $this->updateVal($cart);

                return response()->json(['mensaje' => 'Producto agregado al carrito']);
            }else{
                $productInCart = $response->id;
                if($product->stock >= ($response->stock) + 1){
                    $tableShoppingProducts->where('id', $productInCart)
                                        ->update([
                                            'stock' => ($response->stock + 1),
                                            'total_prices' => ($response->total_prices + $product->price)
                                        ]);
                }else{
                    $stockExcedente = (($response->stock + 1) - $product->stock);
                    $tableShoppingProducts->where('id', $productInCart)
                                        ->update([
                                            'stock' => ($response->stock + 1),
                                            'total_prices' => ($response->total_prices + ($product->price / 2)),
                                            'more_stock' => 1,
                                            'quantity_with_stock' => $stockExcedente,
                                        ]);
                }

                $this->updateVal($cart);

                return response()->json(['mensaje' => 'Producto agregado al carrito']);
            }


        }else{
            return response()->json(['error' => 'Producto no existe']);
        }

    }

    public function updateVal($cart){
        $total = 0;
        $products = DB::table('shopping_carts_has_products')->where('id_cart', $cart->id)->get();
        if(sizeof($products) > 0){
            foreach($products as $product){
                $total = $total + $product->total_prices;
            }
            $cart->update(['total' => $total]);
        }else{
            $cart->update([
                'total' => 0
            ]);
        }
    }

    public function storeCart($user){
        $cart = ShoppingCart::create([
            'user' => $user->id,
            'total' => 0
        ]);
        return $cart;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\shoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = auth()->user();
        $cart = $user->shoppingCart;
        // Verifica que el usuario este ligado a un carrito, en caso de que no, lo creara
        if($cart == null){
            $cart = $this->storeCart($user);
        }
        $products = DB::table('shopping_carts_has_products')->where('id_cart', $cart->id)->get();
        $mix = [];

        for ($i=0; $i < sizeof($products); $i++) {
            $mix[] = [
                'id' => $cart->products[$i]->id,
                'slug' => $cart->products[$i]->slug,
                'name' => $cart->products[$i]->name,
                'nameFor' => $cart->products[$i]->nameFor,
                'stockCurrently' => $cart->products[$i]->stock,
                'priceU' => $products[$i]->price,
                'priceTodo' => $products[$i]->total_prices,
                'stockCart' => $products[$i]->stock,
                'img' => $cart->products[$i]->imagesMain,
            ];
        }

        return response()->json(['cart'=> $cart, 'products' => $cart->products, 'mix' => $mix]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\shoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        $cart = $user->shoppingCart;
        // Verifica que el usuario este ligado a un carrito, en caso de que no, lo creara
        if($cart == null){
            $cart = $this->storeCart($user);
        }
        $product = Product::where('id', $request->product)->where('is_active', 1)->get()->first();
        if($product){
            if($product->stock >= $request->quantity){
                DB::table('shopping_carts_has_products')
                ->where('id_cart', $cart->id)
                ->where('id_product', $request->product)
                ->update(['stock' => $request->quantity]);

                return redirect()->route('carrito')->with('check', 'Update cart');

            }else{
                return redirect()->route('carrito')->with('error', 'insufficient_stock');
            }
        }else{
            return redirect()->route('carrito')->with('error', 'product_no_exits');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\shoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(!auth()->check()){
            return response()->json(['error'=> 'login', 'redirect' => route('login')]);
        }

        $user = auth()->user();
        $cart = $user->shoppingCart;
        // Verifica que el usuario este ligado a un carrito, en caso de que no, lo creara
        if($cart == null){
            $cart = $this->storeCart($user);
        }

        DB::table('shopping_carts_has_products')->where('id_cart', $cart->id)
                                                ->where('id_product', $request->product)
                                                ->delete();

        $this->updateVal($cart);

        return response()->json(['state' => true]);
    }

    public function destroyForm(Request $request){
        $user = auth()->user();
        $cart = $user->shoppingCart;
        // Verifica que el usuario este ligado a un carrito, en caso de que no, lo creara
        if($cart == null){
            $cart = $this->storeCart($user);
        }

        DB::table('shopping_carts_has_products')->where('id_cart', $cart->id)
                                                ->where('id_product', $request->product)
                                                ->delete();

        $this->updateVal($cart);

        return redirect()->route('carrito');
    }
}
