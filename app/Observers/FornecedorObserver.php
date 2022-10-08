<?php

namespace App\Observers;

use App\Models\Fornecedor;

class FornecedorObserver
{
	/**
	 * Handle the Fornecedor "created" event.
	 *
	 * @param  \App\Models\Fornecedor  $fornecedor
	 * @return void
	 */
	public function created(Fornecedor $fornecedor)
	{
		$fornecedor -> insertHistoricoFornecedor();
	}

	/**
	 * Handle the Fornecedor "updated" event.
	 *
	 * @param  \App\Models\Fornecedor  $fornecedor
	 * @return void
	 */
	public function updated(Fornecedor $fornecedor)
	{
		$fornecedor -> insertHistoricoFornecedor();
	}

	/**
	 * Handle the Fornecedor "deleted" event.
	 *
	 * @param  \App\Models\Fornecedor  $fornecedor
	 * @return void
	 */
	public function deleted(Fornecedor $fornecedor)
	{
		//
	}

	/**
	 * Handle the Fornecedor "restored" event.
	 *
	 * @param  \App\Models\Fornecedor  $fornecedor
	 * @return void
	 */
	public function restored(Fornecedor $fornecedor)
	{
		//
	}

	/**
	 * Handle the Fornecedor "force deleted" event.
	 *
	 * @param  \App\Models\Fornecedor  $fornecedor
	 * @return void
	 */
	public function forceDeleted(Fornecedor $fornecedor)
	{
		//
	}
}
