<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatCitaServisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->unsignedBigInteger('client_id');  
            $table->foreign('client_id')->references('id')->on('clientes');
            $table->unsignedBigInteger('user_id');  
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('date');
            $table->time('hourI');
            $table->time('hourF');
            $table->string('direction',350)->nullable();
            $table->string('description',350)->nullable();
            $table->float('price',10,2);
            $table->unsignedBigInteger('state_id');  
            $table->foreign('state_id')->references('id')->on('estado_cita');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citas');
    }
}
