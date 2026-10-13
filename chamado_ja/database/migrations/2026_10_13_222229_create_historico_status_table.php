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
        Schema::create('historico_status', function (Blueprint $table) {
            $table->id('id_historico');
            $table->string('status');
            $table->timestamps('created_at');
            $table->foreignId('chamado_id')
                    ->constrained(
                        table:'chamados',
                        column:'id_chamado'
                    );
            $table->foreignId('usuario_id')
                    ->constrained(
                        table:'usuarios',
                        column:'id_usuario'
                    );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historico_statuses');
    }
};
