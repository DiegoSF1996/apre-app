<?php

namespace App\Http\Controllers\Estudo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Estudo\RespostaRequest;
use App\Services\Estudo\RespostaService;

class RespostaController extends Controller
{

    protected $resposta_service;
    public function __construct(RespostaService $resposta_service){
        $this->resposta_service = $resposta_service;        
    } 
    /**
     * @OA\Get(
     *     path="/api/estudo/respostas",
     *    tags={"respostas"},
     *     summary="Retorna uma lista de respostas",     
     *     description="Index",
     *  @OA\Response(response=200, description="Retorna uma lista de respostas",
     *          ),
     *  security={{ "bearerAuth": {} }}
     * )
     */
    public function index(Request $request)
    {    
         return $this->resposta_service->index($request);              
    }
        /**
        * @OA\Post(
        * path="/api/estudo/respostas",    
        * tags={"respostas"},           
        * summary="Cadastra respostas",
        * description="respostas cadastro",
        *     @OA\RequestBody(        
        *        @OA\JsonContent(        
        *          
		*	@OA\Property(property="descricao"),
		*	@OA\Property(property="questao_id"),
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
    public function store(RespostaRequest $request)
    {        
        return $this->resposta_service->store($request);   
    }

    /**
     * @OA\Get(
     *     path="/api/estudo/respostas/{id}",
     *     tags={"respostas"},   
     *     summary="Consulta respostas",
     *     description="Index",
     *     @OA\Parameter(name="id", in="path", description="Id de respostas", required=true,
     *         @OA\Schema(type="integer")
     *     ),* 
     *  @OA\Response(response=200, description="Retorna uma lista de respostas"),
     *  security={{ "bearerAuth": {} }}
     * )
     */
    public function show($id)
    {
        return $this->resposta_service->show($id);       
    }
  /**
     * @OA\Put(
     *     path="/api/estudo/respostas/{id}",     
     *     tags={"respostas"},   
     *     summary="Atualiza respostas",
     *     description="Update respostas in DB",
     *     @OA\Parameter(name="id", in="path", description="Id de respostas", required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(     
     *        @OA\JsonContent(        
     *          
		*	@OA\Property(property="descricao"),
		*	@OA\Property(property="questao_id"),
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
    public function update(RespostaRequest $request, $id)
    { 
        return $this->resposta_service->update($request,$id);           
    }
    /**
     * @OA\Delete(
     *     path="/api/estudo/respostas/{id}",
     *     tags={"respostas"},   
     *     summary="Exclui respostas",
     *     description="Destroy",
     *     @OA\Parameter(name="id", in="path", description="Id de respostas", required=true,
     *         @OA\Schema(type="integer")
     *     ),* 
     *  @OA\Response(response=200, description="Excluído com sucesso"),
     *  security={{ "bearerAuth": {} }}
     * )
     */
    public function destroy($id)
    {
        return $this->resposta_service->destroy($id);              
    }    
    
}
