<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
  protected $fillable = ['nome', 'descricao', 'peso', 'preco_venda', 'estoque_minimo', 'estoque_maximo', 'unidade_id'];
}
