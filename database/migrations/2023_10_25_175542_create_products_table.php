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
            $table->bigInteger('num_repuesto')->unique();
            $table->string('slug')->unique();

            $table->string('name', 100);
            $table->decimal('price');
            $table->decimal('cost');
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
