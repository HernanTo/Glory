<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::with('customer')->where('is_active', '1')->get();
        return view('facturas.index', ['bills' => $bills]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('stock', '>', 0)->where('is_active', 1)->get();
        $sellersWhitPer = User::join('model_has_permissions', 'users.id', '=', 'model_has_permissions.model_id')
                                    ->join('permissions', 'model_has_permissions.permission_id', '=', 'permissions.id')
                                    ->where('permissions.name', 'create.bills')
                                    ->get();

        $permission = Permission::where('name', 'create.bills')->first();
        $rolSellers = $permission->roles;

        $usersWithRole = collect();

        $users = User::where('is_active', 1)->get();
        foreach($rolSellers as $role){
            foreach($users as $user){
                $userVerification = $user->hasRole($role->name);
                if($userVerification){
                    $usersWithRole->push($user);
                }
            }
        }


        $customers = Customer::where('is_active', 1)->get();

        return view('facturas.create', [
            'products' => $products,
            'sellersPer' => $sellersWhitPer,
            'sellersRole' => $usersWithRole,
            'customers' => $customers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productsError = [];
        if($request->product_id != null){
            for ($i = 0; $i < count($request->product_id); $i++){
                $product_id = $request->product_id[$i];
                $product = Product::find($product_id);

                $product_amount = $request->product_amount[$i];

                if($product_amount<= $product->stock){
                    $product->update([
                        'stock' => $product->stock - $product_amount,
                    ]);
                }else{
                    $productsError[] = [$product->barcode . " - " . $product->name, $product->stock, $product_amount];
                }
            }
        }

        if(count($productsError) > 0){
            return back()->with('productsError', $productsError);
        }

        $iva = $request->iva__check == null ? false : true;
        $subtotal = 0;
        if($request->product_id != null){
            for ($i = 0; $i < count($request->product_id); $i++){
                $product_id = $request->product_id[$i];
                $product = Product::find($product_id);

                $product_amount = $request->product_amount[$i];
                $check_mano_obra = $request->check_mano_obra[$i];
                $price_mano_obra = $request->price_mano_obra[$i];
                $descuento = $request->descuento[$i];

                $priceXQuantity = $product->price * $product_amount;
                $discount = $descuento == 'NA' ? 0 : $descuento;
                $PricesWithDiscount = $priceXQuantity - ($discount * ($discount / 100));

                $subtotal += $PricesWithDiscount;

                if($check_mano_obra == 'true'){
                    $subtotal += intval($price_mano_obra);
                }
            }
        }
        if($request->desc != null){
            for ($i = 0; $i < count($request->desc); $i++){
                $priceMO = str_replace(',', '', $request->priceServ[$i]);
                $subtotal += $priceMO;
            }
        }
        $is_paid = $request->is_paid == 'on' ? true : false;

        $total = $subtotal;
        if($iva){
            $total += $subtotal * 0.19;
        }

        $bill = Bill::create([
            'id_customer' => $request->customer,
            'id_seller' => $request->seller,
            'IVA' => $iva,
            'is_paid' => $is_paid,
            'subtotal' => $subtotal,
            'total' => $total,
            'is_active' => 1,
        ]);

        if($request->desc != null){
            for ($i = 0; $i < count($request->desc); $i++){
                $priceMO = str_replace(',', '', $request->priceServ[$i]);

                Service::create([
                    'id_bill' => $bill->id,
                    'name' => $request->desc[$i],
                    'price' => $priceMO
                ]);
            }
        }
        if($request->product_id != null){
            for ($i = 0; $i < count($request->product_id); $i++){
                $product_id = $request->product_id[$i];
                $product = Product::find($product_id);

                $product_amount = $request->product_amount[$i];
                $check_mano_obra = $request->check_mano_obra[$i];
                $price_mano_obra = $request->price_mano_obra[$i];
                $descuento = $request->descuento[$i];

                $priceXQuantity = $product->price * $product_amount;
                $discount = $descuento == 'NA' ? 0 : $descuento;
                $PricesWithDiscount = $priceXQuantity - ($discount * ($discount / 100));


                DB::table('bills_has_products')->insert([
                    'id_bill' => $bill->id,
                    'id_product' => $product->id,
                    'price' => $product->price,
                    'stock' => $product_amount,
                    'discount' => $discount,
                    'total_prices' => $PricesWithDiscount
                ]);

                if($check_mano_obra == 'true'){
                    $subtotal += intval($price_mano_obra);
                    $nameManoObra = "Mano de obra al repuesto " . $product->name;

                    Service::create([
                        'id_bill' => $bill->id,
                        'name' => $nameManoObra,
                        'price' => $priceMO
                    ]);
                }
            }
        }

        return redirect()->route('bills');

    }

    public function export($id){
        $bill = Bill::find($id);

        if(!$bill){
            abort(404);
        }

        $nameFile = 'Factura_' . $bill->reference . '_Glory.pdf';

        view()->share('facturas.export',$bill);
        $pdf = FacadePdf::setOptions([
                        'enable_remote' => true,
                        'enable_svg' => true,
                        'isFontSubsettingEnabled' => true,
                        'defaultMediaType' =>'all',
                        'isFontSubsettingEnabled'=> true,
                        ])
                        ->loadView('facturas.export', ['bill' => $bill]);

        return $pdf->download($nameFile);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill = Bill::find($id);

        if(!$bill){
            abort(404);
        }

        return view('facturas.bill', ['bill' => $bill]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bill = Bill::find($id);

        if(!$bill){
            abort(404);
        }

        return view('facturas.edit', ['bill' => $bill]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bill = Bill::find($id);

        if(!$bill){
            abort(404);
        }

        $bill->update([
            'is_paid' => $request->is_paid == null ? false : true,
            'IVA' => $request->iva__check == null ? false : true,
        ]);

        return redirect()->route('bills');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $bill = Bill::find($request->id);

        $bill->update([
            "is_active" => 0
        ]);

        return redirect()->route('bills');
    }
}
