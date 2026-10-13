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
        Schema::create('chamados', function (Blueprint $table) {
            $table->id('id_chamado');
            $table->string('titulo');
            $table->string('descricao');
            $table->string('status');
            $table->string('prioridade');
            $table->timestamps('created_at');
            $table->timestamps('updated_at');
            $table->foreignId('usuario_id')
                    ->constrained(
                        table:'usuarios',
                        column:'id_usuario'
                    );
            $table->foreignId('categoria_id')
                    ->constrained(
                        table:'categorias',
                        column:'id_categoria'
                    );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chamados');
    }
};
