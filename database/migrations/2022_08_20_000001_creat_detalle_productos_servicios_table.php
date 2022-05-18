<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatDetalleProductosServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_Productos_Servicios', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->unsignedBigInteger('servis_id');  
            $table->foreign('servis_id')->references('id')->on('servicios');
            $table->unsignedBigInteger('product_id');  
            $table->foreign('product_id')->references('id')->on('productos');
            $table->float('price',10,2);
            $table->Integer('amount');
            
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_Productos_Servicios');
    }
}
