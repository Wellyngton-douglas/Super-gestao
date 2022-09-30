<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fornecedores', function (Blueprint $table) {
			$table->unsignedBigInteger('estados_id');
			$table->foreign('estados_id')->references('id')->on('estados');
			$table->dropColumn('uf');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fornecedores', function (Blueprint $table) {
			$table->dropForeign('fornecedores_estados_id_foreign');
		});

		Schema::table('fornecedores', function (Blueprint $table) {
				$table->dropColumn('estados_id');
				$table->string('uf');
		});
	}
};
