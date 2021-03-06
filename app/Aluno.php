<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Aluno extends Model{
use Sortable;

    protected $fillable =['codigo','apelido','nome','sexo','dataNasc','numBi','naturalidade','residencia','foto','idUser','idContacto','idEncarregado'];


//    protected $sortable = ['apelido','nome','sexo'];

//    public function getInscricao(){
//        return $this->hasMany(Inscricao::class,'idAluno');
//    }

    public function getInscricao(){
        return $this->belongsToMany(Inscricao::class);
    }
}
