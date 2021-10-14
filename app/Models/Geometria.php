<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geometria extends Model
{
    use HasFactory;
    protected $fillable = ['projeto_id', 'nome', 'descricao', 'tipo', 'opcoes', 'arquivo'];

    public function rules() {

        return [
            'projeto_id'    => 'required|exists:projetos,id',
            'descricao'     => "max:1000",
            'tipo'          => 'required',
            'opcoes'        => "max:1000",
            'arquivo'       => "required|file|mimes:xml",
        ];
    }

    public function feedback() {
        return [
            'projeto_id.required'    => 'Indicação do projeto é obrigatória',
            'projeto_id.exists'      => 'Projeto informado não existe',
            'tipo'                   => 'Tipo de arquivo é obrigatório.',
            'descricao.max'          => 'A descrição possui no máximo 1000 de caracteres.',
            'opcoes.max'             => 'As opções possuem no máximo 1000 de caracteres.',
            'file.required'          => 'O arquivo é obrigatório',
            'file.mimes'             => 'O arquivo deve ser do tipo kml'
        ];
    }

    public function projeto() {
        return $this->belongsTo('App\Models\Projeto');
    }
}
