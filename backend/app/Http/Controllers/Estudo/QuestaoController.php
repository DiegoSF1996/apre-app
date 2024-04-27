<?php

namespace App\Http\Controllers\Estudo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Estudo\QuestaoRequest;
use App\Services\Estudo\QuestaoService;

class QuestaoController extends Controller
{

    protected $questao_service;
    public function __construct(QuestaoService $questao_service)
    {
        $this->questao_service = $questao_service;
    }
    /**
     * @OA\Get(
     *     path="/api/estudo/questaos",
     *    tags={"questaos"},
     *     summary="Retorna uma lista de questaos",     
     *     description="Index",
     *  @OA\Response(response=200, description="Retorna uma lista de questaos",
     *          ),
     *  security={{ "bearerAuth": {} }}
     * )
     */
    public function index(Request $request)
    {
        return $this->questao_service->index($request);
    }
    /**
     * @OA\Post(
     * path="/api/estudo/questaos",    
     * tags={"questaos"},           
     * summary="Cadastra questaos",
     * description="questaos cadastro",
     *     @OA\RequestBody(        
     *        @OA\JsonContent(        
     *          
     *	@OA\Property(property="descricao"),
     *	@OA\Property(property="assunto_id"),
     *        ),
     *     ),
     *  security={{ "bearerAuth": {} }},
     *      @OA\Response(
     *          response=201,
     *          description="Cadastrado com sucesso",
     *          @OA\JsonContent()
     *       ),
     * )
     */
    public function store(QuestaoRequest $request)
    {
        return $this->questao_service->store($request);
    }

    /**
     * @OA\Get(
     *     path="/api/estudo/questaos/{id}",
     *     tags={"questaos"},   
     *     summary="Consulta questaos",
     *     description="Index",
     *     @OA\Parameter(name="id", in="path", description="Id de questaos", required=true,
     *         @OA\Schema(type="integer")
     *     ),* 
     *  @OA\Response(response=200, description="Retorna uma lista de questaos"),
     *  security={{ "bearerAuth": {} }}
     * )
     */
    public function show($id)
    {
        return $this->questao_service->show($id);
    }
    /**
     * @OA\Put(
     *     path="/api/estudo/questaos/{id}",     
     *     tags={"questaos"},   
     *     summary="Atualiza questaos",
     *     description="Update questaos in DB",
     *     @OA\Parameter(name="id", in="path", description="Id de questaos", required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(     
     *        @OA\JsonContent(        
     *          
     *	@OA\Property(property="descricao"),
     *	@OA\Property(property="assunto_id"),
     *        ),
     *     ),
     *  security={{ "bearerAuth": {} }},* 
     *     @OA\Response(
     *          response=200, description="Atualizado com sucesso",
     *          @OA\JsonContent(
     *             @OA\Property(property="status_code", type="integer", example="200"),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */
    public function update(QuestaoRequest $request, $id)
    {
        return $this->questao_service->update($request, $id);
    }
    /**
     * @OA\Delete(
     *     path="/api/estudo/questaos/{id}",
     *     tags={"questaos"},   
     *     summary="Exclui questaos",
     *     description="Destroy",
     *     @OA\Parameter(name="id", in="path", description="Id de questaos", required=true,
     *         @OA\Schema(type="integer")
     *     ),* 
     *  @OA\Response(response=200, description="Excluído com sucesso"),
     *  security={{ "bearerAuth": {} }}
     * )
     */
    public function destroy($id)
    {
        return $this->questao_service->destroy($id);
    }
}
