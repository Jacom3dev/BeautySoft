<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->BigIncrements('id');
            
            $table->unsignedBigInteger('id_supplier');
            $table->foreign('id_supplier')->references('NIT')->on('proveedores');
            $table->unsignedBigInteger('user_id');  
            $table->foreign('user_id')->references('id')->on('users');
            $table->float('price',10,2);
            $table->boolean('state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras');
    }
}
