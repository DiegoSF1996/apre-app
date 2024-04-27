<?php

namespace App\Models\Estudo;

use App\Models\Estudo\{Assunto,Resposta};
use App\Models\ModelGenerico;

class Questao extends ModelGenerico
{
    protected $table = 'questao';         
    protected $guarded = ['id'];
    protected $dates = ['created_at','updated_at'];
    protected $fillable = ["descricao","assunto_id"];

    public function assunto(){
        return $this->belongsTo(Assunto::class);
    }
    public function resposta(){
        return $this->hasMany(Resposta::class);
    }
}
