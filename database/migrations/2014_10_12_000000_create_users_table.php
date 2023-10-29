<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cc')->unique();

            $table->string('ft_name', 60);
            $table->string('sc_name', 60)->nullable();
            $table->string('fi_lastname', 60)->nullable();
            $table->string('sc_lastname', 60)->nullable();

            $table->bigInteger('phone_number');
            $table->string('address', 150)->nullable();
            $table->string('profile_photo_path', 2048)->nullable();

            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('pass_change');
            $table->rememberToken();

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
        Schema::dropIfExists('users');
    }
}
