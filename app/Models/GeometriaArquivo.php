<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeometriaArquivo extends Model
{
    use HasFactory;
    protected $fillable = ['geometria_id', 'arquivo_id'];



}
