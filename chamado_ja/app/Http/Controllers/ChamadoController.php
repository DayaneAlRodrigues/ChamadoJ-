<?php

namespace App\Http\Controllers;

use App\Actions\AlterarStatusDoChamado;
use App\Http\Requests\DeleteChamadoRequest;
use App\Http\Requests\StoreChamadoRequest;
use App\Http\Requests\UpdateChamadoRequest;
use App\Http\Requests\UpdateStatusChamadoRequest;
use App\Http\Resources\ChamadoResource;
use App\Models\Chamado;
use DomainException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChamadoController extends Controller
{
    public function index(Request $request)
    {
        $consulta = Chamado::query()
            ->with(['usuario','categoria']);
        
        // filtro por status
        $consulta->when(
            $request->status,
            fn ($consulta,$status) =>
                $consulta->where('status', $status)
        );

        // filtro por prioridade
        $consulta->when(
            $request->prioridade,
            fn ($consulta, $prioridade)=>
                $consulta->where('prioridade', $prioridade)
        );

        //filtro pelo período de criação
        $consulta->when(
            $request->data_inicio,
            fn ($consulta, $data)=>
                $consulta->whereDate('created_at', '>=', $data)
        );

        $consulta->when(
            $request->data_fim,
            fn ($consulta, $data)=>
                $consulta->whereDate('created_at', '<=', $data)
        );

        //filtro por categoria
        $consulta->when(
            $request->categoria_id,
            fn ($consulta,$id) =>
                $consulta->where('categoria_id',$id)
        );

        //filtro por usuário -- retorna o id do usuário, como retornar o nome?
        $consulta->when(
            $request->usuario_id,
            fn ($consulta, $id)=>
                $consulta->where('usuario_id',$id)
        );

        //ordenaçao
        $ordenacoesPermitidas= [
            'created_at',
            'prioridade',
            'status'
        ];

        // verificar a ordenação que foi solicitada
        $ordenacao = in_array(
            $request->ordenar_por,
            $ordenacoesPermitidas,
            true
        ) ? $request->ordenar_por : 'created_at';

        // verificar a direcao da ordenaçao
        $direcao = in_array(
            $request->direcao,
            ['asc','desc'],
            true
        ) ? $request->direcao : 'asc';

        // paginacao
        $chamados = $consulta
            ->orderBy($ordenacao,$direcao)
            ->paginate(15);

        return ChamadoResource::collection($chamados)
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function store(StoreChamadoRequest $request)
    {

        $chamado = Chamado::create([
            ...$request->validated(),
            'status' => 'aberto',
        ]);

        //registrar na tabela de historicosStatus
        $chamado->historicosStatus()->create([
            'status' => $chamado->status,
        ]);

        return (new ChamadoResource(
            $chamado->load(['usuario', 'categoria'])
        ))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(int $id)
    {
        $chamado = Chamado::where('id_chamado', $id)->first();

        if (!$chamado) {
            return response()->json([
                'message' => 'Chamado não encontrado.'
            ], Response::HTTP_NOT_FOUND);
        }

        if ($chamado) {
            return (new ChamadoResource(
                $chamado->load(['usuario', 'categoria'])
            ))
                ->response()
                ->setStatusCode(Response::HTTP_OK);
        }
    }

    public function update(UpdateChamadoRequest $request, int $id)
    {
        $chamado = Chamado::where('id_chamado', $id)->first();

        if (!$chamado) {
            return response()->json([
                'message' => 'Chamado não encontrado.'
            ], Response::HTTP_NOT_FOUND);
        }

        $dados = $request->validated();

        $chamado->update($dados);

        return (new ChamadoResource(
            $chamado->load(['usuario', 'categoria'])
        ))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function updateStatus(UpdateStatusChamadoRequest $request, int $id, AlterarStatusDoChamado $acao)
    {
        $chamado = Chamado::where('id_chamado', $id)->first();

        if (!$chamado) {
            return response()->json([
                'message' => 'Chamado não encontrado.'
            ], Response::HTTP_NOT_FOUND);
        }

        $dados = $request->validated();

        try{
            $chamado = $acao->executar(
                $chamado,
                $dados['status']
            );
        }catch(DomainException $e){
            return response()->json([
                'message'=> $e->getMessage()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return (new ChamadoResource(
            $chamado->load(['usuario', 'categoria'])
        ))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function destroy( int $id){
        $chamado= Chamado::where('id_chamado',$id)->first();

        if (!$chamado) {
            return response()->json([
                'message' => 'Chamado não encontrado.'
            ], Response::HTTP_NOT_FOUND);
        }

        $chamado->delete();

        return response()->noContent();
    }

}