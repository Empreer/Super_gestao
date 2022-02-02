<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutoDetalhesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_detalhes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id'); /* chave estrangeira FK */
            $table->float('comprimento', 8, 2);
            $table->float('altura', 8, 2);
            $table->float('largura', 8, 2);
            $table->timestamps();

            /*Indicacao da Chave Estrangeira */
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->unique('produto_id'); /*Unique é a relacao de 1 para 1 só tem um detalhe por produto */

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produto_detalhes');
    }
}
