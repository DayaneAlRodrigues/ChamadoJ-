<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Categoria;
use App\Models\Usuario;

class ComentarioTest extends TestCase
{
    use RefreshDatabase;
//Teste 1: criação de comentario
    public function test_criar_comentario(): void
    {
        //post('/chamados/{id}/comentarios'
        //Primeiro criar o chamado
        $usuarioAutenticado = Usuario::factory()->create();
        $categoria = Categoria::factory()->create();

        $dados = [
            'titulo' => 'Servidor fora do ar',
            'descricao' =>'Erro para abrir o website',
            'status' => 'aberto',
            'prioridade' => 'baixa',
            'usuario_id'=> $usuarioAutenticado->id_usuario,
            'categoria_id'=> $categoria->id_categoria
        ];

        $responseCriacaoChamado = $this->actingAs($usuarioAutenticado, 'sanctum')
            ->postJson('/api/chamados', $dados);
        
        $responseCriacaoChamado->assertStatus(201);

        $id = $responseCriacaoChamado->json('data.id');

        $this->assertNotNull($id);

        //adicionar o comentario
        $response = $this->postJson("/api/chamados/{$id}/comentarios", [
            'comentario'=>'Servidor está configurado errado e precisa de manutenção.'
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('comentarios', [
            'chamado_id'=>$id,
            'comentario'=>'Servidor está configurado errado e precisa de manutenção.'
        ]);
    }
}
