<?php

namespace App\Http\Controllers\Estudo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Estudo\AssuntoRequest;
use App\Services\Estudo\AssuntoService;

class AssuntoController extends Controller
{

    protected $assunto_service;
    public function __construct(AssuntoService $assunto_service)
    {
        $this->assunto_service = $assunto_service;
    }
    /**
     * @OA\Get(
     *     path="/api/estudo/assuntos",
     *    tags={"assuntos"},
     *     summary="Retorna uma lista de assuntos",     
     *     description="Index",
     *  @OA\Response(response=200, description="Retorna uma lista de assuntos",
     *          ),
     *  security={{ "bearerAuth": {} }}
     * )
     */
    public function index(Request $request)
    {
        return $this->assunto_service->index($request);
    }
    /**
     * @OA\Post(
     * path="/api/estudo/assuntos",    
     * tags={"assuntos"},           
     * summary="Cadastra assuntos",
     * description="assuntos cadastro",
     *     @OA\RequestBody(        
     *        @OA\JsonContent(        
     *          
     *	@OA\Property(property="assunto_id"),
     *	@OA\Property(property="descricao"),
     *	@OA\Property(property="user_id"),
     *	@OA\Property(property="permite_compartilhar"),
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
    public function store(AssuntoRequest $request)
    {
        return $this->assunto_service->store($request);
    }

    /**
     * @OA\Get(
     *     path="/api/estudo/assuntos/{id}",
     *     tags={"assuntos"},   
     *     summary="Consulta assuntos",
     *     description="Index",
     *     @OA\Parameter(name="id", in="path", description="Id de assuntos", required=true,
     *         @OA\Schema(type="integer")
     *     ),* 
     *  @OA\Response(response=200, description="Retorna uma lista de assuntos"),
     *  security={{ "bearerAuth": {} }}
     * )
     */
    public function show($id)
    {
        return $this->assunto_service->show($id);
    }
    /**
     * @OA\Put(
     *     path="/api/estudo/assuntos/{id}",     
     *     tags={"assuntos"},   
     *     summary="Atualiza assuntos",
     *     description="Update assuntos in DB",
     *     @OA\Parameter(name="id", in="path", description="Id de assuntos", required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(     
     *        @OA\JsonContent(        
     *          
     *	@OA\Property(property="assunto_id"),
     *	@OA\Property(property="descricao"),
     *	@OA\Property(property="user_id"),
     *	@OA\Property(property="permite_compartilhar"),
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
    public function update(AssuntoRequest $request, $id)
    {
        return $this->assunto_service->update($request, $id);
    }
    /**
     * @OA\Delete(
     *     path="/api/estudo/assuntos/{id}",
     *     tags={"assuntos"},   
     *     summary="Exclui assuntos",
     *     description="Destroy",
     *     @OA\Parameter(name="id", in="path", description="Id de assuntos", required=true,
     *         @OA\Schema(type="integer")
     *     ),* 
     *  @OA\Response(response=200, description="Excluído com sucesso"),
     *  security={{ "bearerAuth": {} }}
     * )
     */
    public function destroy($id)
    {
        return $this->assunto_service->destroy($id);
    }
}
