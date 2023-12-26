<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPedidoToShoppingCartsHasProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shopping_carts_has_products', function (Blueprint $table) {
            $table->tinyInteger('more_stock');
            $table->bigInteger('quantity_with_stock');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shopping_carts_has_products', function (Blueprint $table) {
            //
        });
    }
}
