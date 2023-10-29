<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BillsHasProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills_has_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_bill');
            $table->unsignedBigInteger('id_product');

            $table->decimal('price');
            $table->bigInteger('stock');
            $table->bigInteger('discount');

            $table->decimal('total_prices');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
