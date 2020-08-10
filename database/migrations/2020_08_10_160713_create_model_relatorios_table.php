<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelRelatoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relatorios', function (Blueprint $table) {
            $table->bigIncrements('id_relatorio');
            $table->bigInteger('id_produto')->unsigned();
            $table->foreign('id_produto')->references('id')->on('produtos')->onDelete('cascade');
            $table->integer('quantidade_movimentacao');
            $table->string('tipo_movimentacao');
            $table->string('canal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relatorios');
    }
}
