<?php

namespace App\Models\Estudo;

use App\Models\ModelGenerico;

class Assunto extends ModelGenerico
{   
    protected $table = 'assunto';         
    protected $guarded = ['id'];
    protected $dates = ['created_at','updated_at'];
    protected $fillable = ["assunto_id","descricao","user_id","permite_compartilhar"];

    public function assunto(){
        return $this->hasMany(Self::class);
    }
    public function assuntoRecursivo(){
        return $this->assunto()->with('assuntoRecursivo');
    }
}
