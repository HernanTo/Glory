<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingCartsHasProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_carts_has_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_product');
            $table->unsignedBigInteger('id_cart');

            $table->bigInteger('price');
            $table->bigInteger('stock');

            $table->bigInteger('total_prices');
            $table->timestamps();
            
            $table->foreign('id_product')->references('id')->on('products');
            $table->foreign('id_cart')->references('id')->on('shopping_carts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopping_carts_has_products');
    }
}
