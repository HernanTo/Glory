<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer');
            $table->unsignedBigInteger('seller');

            $table->tinyInteger('IVA');
            $table->tinyInteger('payment');

            $table->decimal('subtotal');
            $table->decimal('total');

            $table->tinyInteger('is_active');
            $table->timestamps();

            $table->foreign('customer')->references('id')->on('cliente');
            $table->foreign('seller')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
