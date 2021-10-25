<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    use HasFactory;
    protected $fillable = ['projeto_id', 'nome', 'nome_original', 'descricao', 'tipo', 'file'];

    public function rules() {

        return [
            'projeto_id' => 'required|exists:projetos,id',
            'nome'       => "required|min:3|max:100",
            'descricao'  => "max:1000",
            'tipo'       => 'required',
            'file'       => "required|file|mimes:pdf,xls,xlsx,doc,docx,ppt,png,jpg,jpeg,tif,kml,kmz,zip,rar",
        ];
    }

    public function feedback() {
        return [
            'projeto_id.required' => 'Indicação do projeto é obrigatória',
            'projeto_id.exists'   => 'Projeto informado não existe',
            'nome.required'       => 'Nome do arquivo é obrigatório',
            'nome.min'            => 'Nome do arquivo deve ter no mínimo 3 caracteres',
            'nome.max'            => 'Nome do arquivo deve ter no máximo 100 caracteres',
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
