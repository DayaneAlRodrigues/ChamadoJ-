<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChamadoTest extends TestCase
{
    use RefreshDatabase;
    //Teste 1: criar chamado valido
    public function test_pode_criar_chamado_valido():void{
        $usuarioAutenticado = Usuario::factory()->create();
        $categoria = Categoria::factory()->create();

        $dados = [
            'titulo' => 'Computador não liga',
            'descricao' =>'Erro ao ligar o computador',
            'status' => 'aberto',
            'prioridade' => 'baixa',
            'usuario_id'=> $usuarioAutenticado->id_usuario,
            'categoria_id'=> $categoria->id_categoria
        ];

        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
            ->postJson('/api/chamados', $dados);
        
        $response->assertStatus(201);

        $this->assertDatabaseHas('chamados', [
            'titulo' => 'Computador não liga',
            'descricao' =>'Erro ao ligar o computador',
            'status' => 'aberto',
            'prioridade' => 'baixa',
            'usuario_id'=> $usuarioAutenticado->id_usuario,
            'categoria_id'=> $categoria->id_categoria
        ]);
    }
}
