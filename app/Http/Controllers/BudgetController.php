<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budgets = Budget::with('customer')->where('is_active', '1')->get();

        return view('cotizaciones.index', ['budgets' => $budgets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        $sellersWhitPer = User::join('model_has_permissions', 'users.id', '=', 'model_has_permissions.model_id')
                                    ->join('permissions', 'model_has_permissions.permission_id', '=', 'permissions.id')
                                    ->where('permissions.name', 'create.bills')
                                    ->get();

        $permission = Permission::where('name', 'create.budgets')->first();
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

        return view('cotizaciones.create', [
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
        $iva = $request->iva__check == null ? false : true;
        $subtotal = 0;

        if($request->product_id != null){
            for ($i = 0; $i < count($request->product_id); $i++){
                $product_id = $request->product_id[$i];
                $product = Product::find($product_id);

                $product_amount = $request->product_amount[$i];
                $descuento = $request->descuento[$i];

                $priceXQuantity = $product->price * $product_amount;
                $discount = $descuento == 'NA' ? 0 : $descuento;
                $PricesWithDiscount = $priceXQuantity - ($discount * ($discount / 100));

                $subtotal += $PricesWithDiscount;
            }
        }
        $total = $subtotal;
        if($iva){
            $total += $subtotal * 0.19;
        }

        $budget = Budget::create([
            'id_customer' => $request->customer,
            'id_seller' => $request->seller,
            'IVA' => $iva,
            'subtotal' => $subtotal,
            'total' => $total,
            'is_active' => 1,
        ]);

        if($request->product_id != null){
            for ($i = 0; $i < count($request->product_id); $i++){
                $product_id = $request->product_id[$i];
                $product = Product::find($product_id);

                $product_amount = $request->product_amount[$i];
                $descuento = $request->descuento[$i];

                $priceXQuantity = $product->price * $product_amount;
                $discount = $descuento == 'NA' ? 0 : $descuento;
                $PricesWithDiscount = $priceXQuantity - ($discount * ($discount / 100));


                DB::table('budgets_has_products')->insert([
                    'id_budget' => $budget->id,
                    'id_product' => $product->id,
                    'price' => $product->price,
                    'stock' => $product_amount,
                    'discount' => $discount,
                    'total_prices' => $PricesWithDiscount
                ]);
            }
        }

        return redirect()->route('budgets');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $budget = Budget::find($id);

        if(!$budget){
            abort(404);
        }

        return view('cotizaciones.cotizacion', ['budget' => $budget]);
    }

    public function export($id){
        $budget = Budget::find($id);

        if(!$budget){
            abort(404);
        }

        $nameFile = 'Cotizacion_' . $budget->reference . '_Glory.pdf';

        $date = Carbon::parse($budget->created_at->addDays(15));

        view()->share('cotizaciones.export', $budget, $date);
        $pdf = FacadePdf::setOptions([
                        'enable_remote' => true,
                        'enable_svg' => true,
                        'isFontSubsettingEnabled' => true,
                        'defaultMediaType' =>'all',
                        'isFontSubsettingEnabled'=> true,
                        ])
                        ->loadView('cotizaciones.export', ['budget' => $budget, 'date' => $date]);

        return $pdf->stream($nameFile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $budget = Budget::find($id);

        if(!$budget){
            abort(404);
        }

        return view('cotizaciones.edit', ['budget' => $budget]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $budget = Budget::find($id);

        if(!$budget){
            abort(404);
        }

        $budget->update([
            'IVA' => $request->iva__check == null ? false : true,
        ]);

        return redirect()->route('budgets');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $budget = Budget::find($request->id);

        $budget->update([
            "is_active" => 0
        ]);

        return redirect()->route('budgets');
    }
}
