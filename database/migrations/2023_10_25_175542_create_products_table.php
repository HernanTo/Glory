<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('barcode')->unique();
            $table->string('num_repuesto', '500')->unique();
            $table->string('slug')->unique();

            $table->string('name', 100);
            $table->bigInteger('price');
            $table->bigInteger('cost');
            $table->longText('description')->nullable();

            $table->bigInteger('stock');
            $table->bigInteger('min_stock');
            $table->bigInteger('available');

            $table->tinyInteger('is_active');
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
        Schema::dropIfExists('products');
    }
}
