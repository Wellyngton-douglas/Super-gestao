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
		Schema::table('produtos', function (Blueprint $table) {
			$table->dropForeign('produtos_unidade_id_foreign');
			$table->dropColumn('unidade_id');
			$table->dropColumn('peso');
		});

		Schema::table('produtos_detalhes', function (Blueprint $table) {
			$table->integer('peso') -> after('altura') -> nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('produtos_detalhes', function (Blueprint $table) {
			$table->dropColumn('peso');
		});

		Schema::table('produtos', function (Blueprint $table) {
			$table->unsignedBigInteger('unidade_id');
			$table->foreign('unidade_id')->references('id')->on('unidades');
			$table->integer('peso') -> after('descricao') -> nullable();
		});		
	}
};
