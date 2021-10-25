<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projetos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nome', '100')->unique();
            $table->string('tipo', '40');
            $table->text('descricao')->nullable();
            $table->date('iniciado_em')->nullable();
            $table->date('finalizado_em')->nullable();
            $table->boolean('publico')->default(false);
            $table->timestamps();

            // Foreign Key (constraints)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projeto');
    }
}
