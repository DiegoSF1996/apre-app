<?php

namespace App\Services\Estudo;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use App\Models\Estudo\Questao;

class QuestaoService
{
    protected $questao;
    public function __construct(Questao $questao)
    {
        $this->questao = $questao;
    }
    public function index($request)
    {
       $data = $this->questao->with(['assunto','resposta'])->orderBy('descricao');
        if ($request->filled('search')) {            
            $data = $data->whereRaw("unaccent(descricao) ILIKE unaccent(?)", "%" . $request->search . "%");
        }
        if ($request->filled('limit') && $request->limit == '-1') {
            $data = ["data" => $this->questao->get()];
            return response()->json($data, Response::HTTP_OK );
        } else {
            $page_limit = $request->filled('per_page') ? $request->per_page : config('app.pageLimit');
            $data = $data->paginate($page_limit);
        }
        return response()->json($data, Response::HTTP_OK );
    }
    public function store($request)
    {
        $dataFrom = $request->all();
        DB::beginTransaction();
        try {
            $data = $this->questao->create($dataFrom);
            DB::commit();
            return response()->json($data,Response::HTTP_CREATED ) ;
        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json(["message"=>'Não foi possível cadastrar',"error" => $e->getMessage()], Response::HTTP_NOT_ACCEPTABLE );
        }
    }
    public function show($id)
    {
        $data = $this->questao->with(['assunto'])->find($id);
        if(!$data){
            return response()->json(['message'=>'Não foi possível executar a ação', 'error'=>['Dados não encontrados']],Response::HTTP_NOT_FOUND) ;
        }
        return response()->json($data,Response::HTTP_OK ) ;
    }
    public function update($request, $id)
    {
        $data = $this->questao->find($id);
        if (!$data) {
            return response()->json(['message'=>'Não foi possível executar a ação', 'error'=>['Dados não encontrados']],Response::HTTP_NOT_FOUND) ;
        }
        $dataFrom = $request->all();
        DB::beginTransaction();
        try {
            $data->update($dataFrom);
            DB::commit();
            return response()->json($data,Response::HTTP_OK ) ;
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["message" => 'Não foi possível atualizar', "error" => $e->getMessage()], Response::HTTP_NOT_ACCEPTABLE);
        }
    }

    public function destroy($id)
    {
        $data = $this->questao->find($id);
        if(!$data){
            return response()->json(['message'=>'Não foi possível executar a ação', 'error'=>['Dados não encontrados']],Response::HTTP_NOT_FOUND) ;
        }
        DB::beginTransaction();
        try {
            $data->delete();
            DB::commit();
            return response()->json(['success'=>'Deletado com sucesso.'],Response::HTTP_OK ) ;
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["message"=>'Não foi possível excluir',"error" => $e->getMessage()], Response::HTTP_NOT_ACCEPTABLE );
        }
    }

}
