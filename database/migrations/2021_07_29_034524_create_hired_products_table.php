<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHiredProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hired_products', function (Blueprint $table) {
            $table->bigIncrements('hire_id');
            //$table->foreign('id')->references('id')->on('users');
            $table->foreignId('user_id');
            //$table->foreign('product_id')->references('product_id')->on('products');
            $table->foreignId('product_id');
            $table->dateTime('hired_at')->default(DB::raw('NOW()'));
            $table->string('duration');
            $table->dateTime('hired_ended_at')->nullable();
            $table->integer('total_price');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('hired_products');
    }
}
