<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('customer_id');
            $table->integer('pty');
            $table->integer('price');
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('no action')->onUpdate('no action');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('no action')->onUpdate('no action');
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
