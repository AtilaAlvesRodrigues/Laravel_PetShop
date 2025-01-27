<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendamentosTable extends Migration
{
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('animal_id');
            $table->unsignedBigInteger('servico_id');
            $table->dateTime('data_hora');
            $table->text('observacoes')->nullable();
            $table->enum('status', ['agendado', 'concluido', 'cancelado'])->default('agendado');
            $table->foreign('animal_id')->references('id')->on('animais');
            $table->foreign('servico_id')->references('id')->on('servicos');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agendamentos');
    }
}