<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class UsuarioTest extends TestCase
{
    use RefreshDatabase;
    
    // Teste 1: criar usuário válido
    public function test_pode_criar_usuario_com_dados_validos(): void{
        $dados = [
            'nome_usuario'=>'Ana Carolina',
            'email' => 'ana_carolina@gmail.com',
            'senha' => 'ano2026intenso'
        ];

        $response = $this->postJson('/api/usuarios', $dados);

        $response->assertStatus(201);

        $this->assertDatabaseHas('usuarios',[
            'nome_usuario'=>'Ana Carolina',
            'email'=>'ana_carolina@gmail.com'
        ]);

        // verifica se a senha foi criptografada
        $usuario = Usuario::where('email','ana_carolina@gmail.com')->first();

        $this->assertNotNull($usuario);

        $this->assertTrue(Hash::check('ano2026intenso', $usuario->senha));
    }

    // Teste 2: não pode criar um usuario sem nome
    public function test_nao_pode_criar_usuario_sem_nome():void{
        $dados = [
            'email'=> 'maria@gmail.com',
            'senha'=> 'trem'
        ];

        $response = $this-> postJson('/api/usuarios', $dados);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('nome_usuario');

        $this->assertDatabaseMissing('usuarios',[
            'email'=>'maria@gmail.com'
        ]);
    }

    // Teste 3: não pode consultar um usuario inexistente
    public function test_nao_pode_consultar_usuario_inexistente():void{
        //precisa estar autenticado para consultar um usuario
        $usuarioAutenticado = Usuario::factory()->create();

        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
            ->getJson('/api/usuarios/99999');

        $response->assertStatus(404);

        $response->assertJson([
            'message'=>'Usuário não encontrado.'
        ]);
    }
}
