<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetalleServicio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Detalle_cita_servicios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('servis_id');  
            $table->foreign('servis_id')->references('id')->on('servicios');
            $table->unsignedBigInteger('schedule_id');  
            $table->foreign('schedule_id')->references('id')->on('citas');
            $table->float('price',8,2);
     
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Detalle_cita_servicios');
    }
}
