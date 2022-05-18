<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->String('name',50);
            $table->unsignedBigInteger('document_id');  
            $table->foreign('document_id')->references('id')->on('tipo_documentos');
            $table->String('document',13);
            $table->String('cell',13)->nullable();
            $table->String('direction',30)->nullable();
            $table->String('email',50)->nullable();
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
        Schema::dropIfExists('clientes');
    }
}
