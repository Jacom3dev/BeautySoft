<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_Ventas_productos', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->unsignedBigInteger('sale_id');  
            $table->foreign('sale_id')->references('id')->on('ventas');
            $table->unsignedBigInteger('product_id')->nullable();  
            $table->foreign('product_id')->references('id')->on('productos');
            $table->Integer('amount')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */



  
    public function down()
    {
        Schema::dropIfExists('detalle_ventas_productos');
    }
};
