<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Pedidos
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('dateorder')->comments('Fecha del pedido');
            $table->timestamps();
        });
        
        //líneas del pedido
        Schema::create('orderlines', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('order_id')->unsigned();
                $table->foreign('order_id')->references('id')->on('orders');
                $table->bigInteger('product_id')->unsigned();
                $table->foreign('product_id')->references('id')->on('products');
                $table->integer('units')->default(0);
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
        Schema::dropIfExists('orderlines');
        Schema::dropIfExists('orders');
    }
}
