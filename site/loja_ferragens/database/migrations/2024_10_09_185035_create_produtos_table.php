<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idSecao')->constrained('secao');
            $table->foreignId('idUniMedida')->constrained('unidade_medidas');
            $table->string('nome');
            $table->string('descricaoProduto');
            $table->float('preco');
            $table->float('estoque');
            $table->boolean('produto_destaque')->default(0);
            $table->boolean('produto_ativo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
