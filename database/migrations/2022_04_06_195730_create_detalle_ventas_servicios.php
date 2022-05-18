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
        Schema::create('detalle_Ventas_Servicios', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->unsignedBigInteger('sale_id');  
            $table->foreign('sale_id')->references('id')->on('ventas');
            $table->unsignedBigInteger('servis_id')->nullable();  
            $table->foreign('servis_id')->references('id')->on('servicios');
            
            
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_ventas_servicios');
    }
};
