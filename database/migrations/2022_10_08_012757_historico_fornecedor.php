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
    Schema::create('historico_fornecedores', function (Blueprint $table) {
			$table->id();
      $table->unsignedBigInteger('fornecedor_id');
      $table->unsignedBigInteger('user_id');
			$table->foreign('fornecedor_id')->references('id')->on('fornecedores');
      $table->foreign('user_id')->references('id')->on('users');
			$table->timestamps();
		});
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::disableForeignKeyConstraints();
		Schema::dropIfExists('historico_fornecedores');
    Schema::enableForeignKeyConstraints();
  }
};
