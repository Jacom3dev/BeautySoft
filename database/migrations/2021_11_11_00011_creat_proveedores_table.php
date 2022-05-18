<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->BigIncrements('NIT');
            $table->String('enterprise',50);
            $table->String('supplier',50);
            $table->String('cell',10)->nullable();
            $table->String('email',50)->nullable();
            $table->String('direction',350)->nullable();
            $table->boolean('state');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedores');
    }
}
