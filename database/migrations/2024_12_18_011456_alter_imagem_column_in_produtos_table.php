<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterImagemColumnInProdutosTable extends Migration
{
    public function up()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->string('imagem')->nullable()->change();  // Permite valores nulos
        });
    }

    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->string('imagem')->nullable(false)->change();  // Volta a não permitir valores nulos
        });
    }
}
