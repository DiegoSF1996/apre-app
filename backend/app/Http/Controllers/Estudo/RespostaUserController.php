<?php

namespace App\Http\Controllers\Estudo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\estudo\RespostaUserRequest;
use App\Services\estudo\RespostaUserService;

class RespostaUserController extends Controller
{

    protected $resposta_user_service;
    public function __construct(RespostaUserService $resposta_user_service)
    {
        $this->resposta_user_service = $resposta_user_service;
    }
    /**
     * @OA\Get(
     *     path="/api/estudo/respostausers",
     *    tags={"respostausers"},
     *     summary="Retorna uma lista de respostausers",     
     *     description="Index",
     *  @OA\Response(response=200, description="Retorna uma lista de respostausers",
     *          ),
     *  security={{ "bearerAuth": {} }}
     * )
     */
    public function index(Request $request)
    {
        return $this->resposta_user_service->index($request);
    }
    /**
     * @OA\Post(
     * path="/api/estudo/respostausers",    
     * tags={"respostausers"},           
     * summary="Cadastra respostausers",
     * description="respostausers cadastro",
     *     @OA\RequestBody(        
     *        @OA\JsonContent(        
     *          
     *	@OA\Property(property="resposta_id"),
     *	@OA\Property(property="user_id"),
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
    public function store(RespostaUserRequest $request)
    {
        return $this->resposta_user_service->store($request);
    }

    /**
     * @OA\Get(
     *     path="/api/estudo/respostausers/{id}",
     *     tags={"respostausers"},   
     *     summary="Consulta respostausers",
     *     description="Index",
     *     @OA\Parameter(name="id", in="path", description="Id de respostausers", required=true,
     *         @OA\Schema(type="integer")
     *     ),* 
     *  @OA\Response(response=200, description="Retorna uma lista de respostausers"),
     *  security={{ "bearerAuth": {} }}
     * )
     */
    public function show($id)
    {
        return $this->resposta_user_service->show($id);
    }
    /**
     * @OA\Put(
     *     path="/api/estudo/respostausers/{id}",     
     *     tags={"respostausers"},   
     *     summary="Atualiza respostausers",
     *     description="Update respostausers in DB",
     *     @OA\Parameter(name="id", in="path", description="Id de respostausers", required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(     
     *        @OA\JsonContent(        
     *          
     *	@OA\Property(property="resposta_id"),
     *	@OA\Property(property="user_id"),
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
    public function update(RespostaUserRequest $request, $id)
    {
        return $this->resposta_user_service->update($request, $id);
    }
    /**
     * @OA\Delete(
     *     path="/api/estudo/respostausers/{id}",
     *     tags={"respostausers"},   
     *     summary="Exclui respostausers",
     *     description="Destroy",
     *     @OA\Parameter(name="id", in="path", description="Id de respostausers", required=true,
     *         @OA\Schema(type="integer")
     *     ),* 
     *  @OA\Response(response=200, description="Excluído com sucesso"),
     *  security={{ "bearerAuth": {} }}
     * )
     */
    public function destroy($id)
    {
        return $this->resposta_user_service->destroy($id);
    }
}
