<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
  protected $fillable = ['fornecedor_id', 'nome', 'descricao', 'preco_venda', 'estoque_minimo', 'estoque_maximo'];
}
