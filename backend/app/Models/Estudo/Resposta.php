<?php

namespace App\Models\Estudo;

use App\Models\ModelGenerico;

class Resposta extends ModelGenerico
{
    protected $table = 'resposta';         
    protected $guarded = ['id'];
    protected $dates = ['created_at','updated_at'];
    protected $fillable = ["descricao","questao_id"];
}
