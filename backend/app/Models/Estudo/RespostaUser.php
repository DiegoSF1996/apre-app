<?php

namespace App\Models\Estudo;

use App\Models\ModelGenerico;

class RespostaUser extends ModelGenerico
{
    protected $table = 'resposta_user';
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ["resposta_id", "user_id"];
}
