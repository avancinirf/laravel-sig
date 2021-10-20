<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeometriaArquivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geometria_arquivos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('geometria_id');
            $table->unsignedBigInteger('arquivo_id');
            $table->timestamps();
        });

        Schema::table('geometria_arquivos', function (Blueprint $table) {
            $table->foreign('geometria_id')->references('id')->on('geometrias')->onDelete('cascade');
            $table->foreign('arquivo_id')->references('id')->on('arquivos')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('geometria_arquivos');
        Schema::enableForeignKeyConstraints();
    }
}
