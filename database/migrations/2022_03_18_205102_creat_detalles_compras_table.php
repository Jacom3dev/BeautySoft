<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_Compra', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->unsignedBigInteger('buys_id');  
            $table->foreign('buys_id')->references('id')->on('compras');
            $table->unsignedBigInteger('product_id');  
            $table->foreign('product_id')->references('id')->on('productos');
            $table->Integer('amount');
            $table->float('price',11,2);
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_Compra');
    }
};
