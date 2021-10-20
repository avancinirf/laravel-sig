<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'nome', 'descricao', 'iniciado_em', 'finalizado_em', 'publico'];
    protected $dates = ['iniciado_em', 'finalizado_em'];


    public function rules($id = 'NULL') {
        return [
            'user_id'       => 'required|exists:users,id',
            'nome'          => "required|unique:projetos,nome,{$id}|min:6|max:100",
            'descricao'     => 'max:1000',
            'iniciado_em'   => 'date|nullable',
            'finalizado_em' => 'date|nullable',
            'publico'       => 'boolean',
        ];
    }

    public function feedback() {
        return [
            'user_id.required' => 'O campo usuário é obrigatório',
            'required'         => 'O campo :attribute é obrigatório.',
            'nome.unique'      => 'Nome do projeto já existe',
            'nome.min'         => 'Nome deve conter no mínimo 10 caracteres.',
            'nome.max'         => 'Nome deve conter no máximo 100 caracteres.',
            'date'             => 'Formato de data inválido.',
            'descricao.max'    => 'Descrição deve conter no máximo 1000 caracteres.'
        ];
    }


    public function getNomesProjetos() {
        $nomesProjetos = $this->select('id', 'nome')->orderBy('nome')->get();
        return $nomesProjetos;
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function arquivos() {
        return $this->hasMany('App\Models\Arquivo');
    }

    public function geometrias() {
        return $this->hasMany('App\Models\Geometria');
    }


}
