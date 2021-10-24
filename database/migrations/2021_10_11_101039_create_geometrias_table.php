<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeometriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geometrias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('projeto_id');
            $table->string('nome', '100');
            $table->string('nome_original', '100');
            $table->text('descricao', 1000)->nullable();
            $table->string('tipo', 100)->default('kml');
            $table->string('file', 100)->unique();
            $table->text('opcoes', 1000)->nullable();
            $table->timestamps();

            // Foreign Key (constraints)
            $table->foreign('projeto_id')->references('id')->on('projetos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geometrias');
    }
}
