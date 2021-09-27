<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    use HasFactory;
    protected $fillable = ['projeto_id', 'nome', 'descricao', 'tipo', 'arquivo'];

    public function rules() {

        return [
            'projeto_id' => 'required|exists:projetos,id',
            'nome'       => "required|min:5|max:50",
            'descricao'  => "max:1000",
            'tipo'       => 'required',
            'arquivo'    => "required|file|mimes:pdf,xls,xlsx,doc,docx,ppt,png,jpg,jpeg,tif,kml,kmz,zip,rar",
        ];
    }

    public function feedback() {
        return [
            'nome.required'       => 'Campo nome é obrigatório.',
            'nome.min'            => 'O nome possui no mínimo 3 de caracteres.',
            'nome.max'            => 'O nome possui no máximo 50 de caracteres.',
            'projeto_id.required' => 'Indicação do projeto é obrigatória',
            'projeto_id.exists'   => 'Projeto informado não existe',
            'tipo'                => 'Tipo de arquivo é obrigatório.',
            'descricao.max'       => 'A descrição possui no máximo 1000 de caracteres.',
            'file.required'       => 'O arquivo é obrigatório',
            'file.mimes'          => 'O arquivo deve ser do tipo pdf|xls|xlsx|doc|docx|ppt|png|jpg|jpeg|tif|kml|kmz|zip|rar'
        ];
    }

    public function projeto() {
        return $this->belongsTo('App\Models\Projeto');
    }
}
