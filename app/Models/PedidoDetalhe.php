<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoDetalhe extends Model
{
  protected $table = 'pedidos_produtos';
	protected $fillable = ['pedido_id', 'produto_id'];
}
