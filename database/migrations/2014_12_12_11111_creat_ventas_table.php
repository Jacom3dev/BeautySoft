<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->unsignedBigInteger('client_id');  
            $table->foreign('client_id')->references('id')->on('clientes');
            $table->unsignedBigInteger('user_id');  
            $table->foreign('user_id')->references('id')->on('users');
            $table->decimal('price',10,2);
            $table->float('state',8,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
