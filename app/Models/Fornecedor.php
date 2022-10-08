<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
	use HasFactory;
	protected $table = 'fornecedores';
	protected $fillable = ['nome', 'site', 'estados_id', 'email'];

	public function historicoFornecedor(){
		return $this->hasMany(HistoricoFornecedor::class)->orderBy('created_at','desc');
	}

	public function insertHistoricoFornecedor() : HistoricoFornecedor{
		return HistoricoFornecedor::Create([
			'fornecedor_id' => $this -> id,
			'user_id' => $_SESSION['id']
		// ],
		// [
		// 	'fornecedor_id' => $this -> id,
		// 	'user_id' => $_SESSION['id']
		]);
	}
}
