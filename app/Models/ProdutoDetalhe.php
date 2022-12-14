<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoDetalhe extends Model
{
	protected $table = 'produtos_detalhes';
	protected $fillable = ['produto_id', 'comprimento', 'largura', 'altura', 'peso', 'unidade_id'];
}
