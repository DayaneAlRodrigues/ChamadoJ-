<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Usuario;

class CategoriaTest extends TestCase
{
    use RefreshDatabase;

   // Teste 1: criação válida de categoria
   public function test_pode_criar_categoria():void{
    //precisa estar autenticado para consultar um usuario
        $usuarioAutenticado = Usuario::factory()->create();

        $dados = [
            'nome_categoria'=>'Infraestrutura',
            'tipo'=>'Software'
        ];

        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
            ->postJson('/api/categorias', $dados);
        
        $response->assertStatus(201);

        $this->assertDatabaseHas('categorias', [
            'nome_categoria'=>'Infraestrutura',
            'tipo'=> 'Software'
        ]);
   }

   //Teste 2: nome categoria ausente
   public function test_nao_pode_criar_categoria_sem_nome():void{
        $usuarioAutenticado = Usuario::factory()->create();

        $dados = [
            'tipo'=>'Software'
        ];

        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
            ->postJson('/api/categorias', $dados);
        
        $response->assertStatus(422);

        $response->assertJsonValidationErrors('nome_categoria');
        $this->assertDatabaseMissing('categorias',[
            'tipo'=>'Software'
        ]);
   }

   //Teste 3: consultar categoria que não existe
   public function test_nao_pode_consultar_categoria_inexistente():void{
        $usuarioAutenticado = Usuario::factory()->create();

        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
            ->getJson('/api/categorias/48394');
        
        $response->assertStatus(404);
        $response->assertJson([
            'message'=>'Categoria não encontrada.'
        ]);

   }
}
