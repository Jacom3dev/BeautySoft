<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->string('name',50);
            $table->string('img',500)->nullable();
            $table->Integer('amount');
            $table->float('price_buys',8,2)->nullable();
            $table->float('price_sale',10,2);
            $table->boolean('state');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
