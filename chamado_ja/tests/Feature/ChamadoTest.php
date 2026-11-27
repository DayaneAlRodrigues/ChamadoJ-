<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Chamado;
use Tests\TestCase;

class ChamadoTest extends TestCase
{
    use RefreshDatabase;
    //Teste 1: criar chamado valido
    public function test_pode_criar_chamado_valido(): void
    {
        $usuarioAutenticado = Usuario::factory()->create();
        $categoria = Categoria::factory()->create();

        $dados = [
            'titulo' => 'Computador não liga',
            'descricao' => 'Erro ao ligar o computador',
            'status' => 'aberto',
            'prioridade' => 'baixa',
            'usuario_id' => $usuarioAutenticado->id_usuario,
            'categoria_id' => $categoria->id_categoria
        ];

        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
            ->postJson('/api/chamados', $dados);

        $response->assertStatus(201);

        $this->assertDatabaseHas('chamados', [
            'titulo' => 'Computador não liga',
            'descricao' => 'Erro ao ligar o computador',
            'status' => 'aberto',
            'prioridade' => 'baixa',
            'usuario_id' => $usuarioAutenticado->id_usuario,
            'categoria_id' => $categoria->id_categoria
        ]);
    }

    //Teste 2: titulo de chamado ausente
    public function test_nao_pode_criar_chamado_sem_titulo(): void
    {
        $usuarioAutenticado = Usuario::factory()->create();
        $categoria = Categoria::factory()->create();
        $dados = [
            'descricao' => 'Erro ao ligar o computador',
            'status' => 'aberto',
            'prioridade' => 'baixa',
            'usuario_id' => $usuarioAutenticado->id_usuario,
            'categoria_id' => $categoria->id_categoria
        ];

        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
            ->postJson('/api/chamados', $dados);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('titulo');
        $this->assertDatabaseMissing('chamados', [
            'titulo' => 'Computador não liga'
        ]);
    }

    //Teste 3: consultar chamado que não existe
    public function test_nao_pode_consultar_chamado_inexistente(): void
    {
        $usuarioAutenticado = Usuario::factory()->create();
        $response = $this->actingAs($usuarioAutenticado, 'sanctum')
            ->getJson('/api/chamados/9999');
        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'Chamado não encontrado.'
        ]);
    }

    //Teste 4: alteracao de status válida patch('/chamados/{id}/status',
    public function test_pode_alterar_status(): void
    {
        //primeiro criar um chamado
        $usuarioAutenticado = Usuario::factory()->create();
        $categoria = Categoria::factory()->create();

        $dados = [
            'titulo' => 'Computador não liga',
            'descricao' => 'Erro ao ligar o computador',
            'status' => 'aberto',
            'prioridade' => 'baixa',
            'usuario_id' => $usuarioAutenticado->id_usuario,
            'categoria_id' => $categoria->id_categoria
        ];

        $responseCriacaoChamado = $this->actingAs($usuarioAutenticado, 'sanctum')
            ->postJson('/api/chamados', $dados);

        $responseCriacaoChamado->assertStatus(201);

        $id = $responseCriacaoChamado->json('data.id');

        $this->assertNotNull($id);

        //agora mudar o status - de aberto para em atendimento
        $response = $this->patchJson("/api/chamados/{$id}/status", [
            'status' => 'em_atendimento',
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('chamados', [
            'id_chamado' => $id,
            'status' => 'em_atendimento'
        ]);
    }

    //Teste 5: alteracao de status inválida patch('/chamados/{id}/status',
    public function test_nao_pode_alterar_status(): void
    {
        //primeiro criar um chamado
        $usuarioAutenticado = Usuario::factory()->create();
        $categoria = Categoria::factory()->create();

        $dados = [
            'titulo' => 'Manutencao na rede da empresa',
            'descricao' => 'Erro ao conectar com a rede',
            'status' => 'aberto',
            'prioridade' => 'baixa',
            'usuario_id' => $usuarioAutenticado->id_usuario,
            'categoria_id' => $categoria->id_categoria
        ];

        $responseCriacaoChamado = $this->actingAs($usuarioAutenticado, 'sanctum')
            ->postJson('/api/chamados', $dados);

        $responseCriacaoChamado->assertStatus(201);

        $id = $responseCriacaoChamado->json('data.id');

        $this->assertNotNull($id);

        // Tentar mudar diretamente de aberto para resolvido (transição inválida)
        $response = $this->patchJson("/api/chamados/{$id}/status", [
            'status' => 'resolvido',
        ]);

        $response->assertStatus(422);

        $this->assertDatabaseHas('chamados', [
            'id_chamado' => $id,
            'status' => 'aberto'
        ]);

    }

    // Teste 6: paginação dos chamados
    public function test_lista_chamados_com_paginacao(): void
    {
        $usuario = Usuario::factory()->create();
        $categoria = Categoria::factory()->create();

        // Criar 16 chamados
        Chamado::factory()->count(16)->create([
            'usuario_id' => $usuario->id_usuario,
            'categoria_id' => $categoria->id_categoria,
        ]);

        $response = $this->actingAs($usuario, 'sanctum')
            ->getJson('/api/chamados');

        $response->assertStatus(200);

        // Verificar a quantidade de registros da primeira página
        $response->assertJsonCount(15, 'data');

        // Verificar informações da paginação
        $response->assertJsonPath('meta.current_page', 1);
        $response->assertJsonPath('meta.last_page', 2);
        $response->assertJsonPath('meta.total', 16);

        // Consultar a segunda página
        $responsePagina2 = $this->getJson('/api/chamados?page=2');

        $responsePagina2->assertStatus(200);
        $responsePagina2->assertJsonCount(1, 'data');
        $responsePagina2->assertJsonPath('meta.current_page', 2);
    }

    // Teste 7: filtro por status
    public function test_filtrar_chamados_por_status(): void
    {
        $usuario = Usuario::factory()->create();
        $categoria = Categoria::factory()->create();

        // Criar chamados com status diferentes
        Chamado::factory()->count(3)->create([
            'status' => 'aberto',
            'usuario_id' => $usuario->id_usuario,
            'categoria_id' => $categoria->id_categoria,
        ]);

        Chamado::factory()->count(2)->create([
            'status' => 'resolvido',
            'usuario_id' => $usuario->id_usuario,
            'categoria_id' => $categoria->id_categoria,
        ]);

        // Consultar somente chamados abertos
        $response = $this->actingAs($usuario, 'sanctum')
            ->getJson('/api/chamados?status=aberto');

        $response->assertStatus(200);

        // Encontrar somente os 3 chamados abertos
        $response->assertJsonCount(3, 'data');

        foreach ($response->json('data') as $chamado) {
            $this->assertEquals('aberto', $chamado['status']);
        }
    }

}
