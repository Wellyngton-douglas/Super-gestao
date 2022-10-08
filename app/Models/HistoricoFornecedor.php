<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoFornecedor extends Model
{
	use HasFactory;
	protected $table = 'historico_fornecedores';
	protected $fillable = ['fornecedor_id', 'user_id'];

	public function user(){
		return $this->belongsTo(User::class);
	}
}
