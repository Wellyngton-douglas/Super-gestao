<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\ProdutoDetalheController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PedidoDetalheController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PrincipalController::class, 'principal']) -> name('site.index');

Route::get('/contato', [ContatoController::class, 'contato']) -> name('site.contato');
Route::post('/contato', [ContatoController::class, 'salvar']) -> name('site.contato');

Route::get('/sobre-nos', [SobreNosController::class, 'sobreNos']) -> name('site.sobrenos');

Route::get('/login/{erro?}', [LoginController::class, 'index']) -> name('site.login');
Route::post('/login', [LoginController::class, 'autenticar']) -> name('site.login');

Route::middleware('autenticacao:padrao,visitante,p3,p4') -> prefix('app') -> group(function() {
  Route::get('/home', [HomeController::class, 'index']) -> name('app.home');
  Route::get('/sair', [LoginController::class, 'sair']) -> name('app.sair');

  //fornecedor
  Route::get('/fornecedor', [FornecedorController::class, 'index']) -> name('app.fornecedor');
  Route::get('/fornecedor/listar', [FornecedorController::class, 'listar']) -> name('app.fornecedor.listar');
  Route::post('/fornecedor/listar', [FornecedorController::class, 'listar']) -> name('app.fornecedor.listar');
  Route::get('/fornecedor/editar/{id}/{msg?}', [FornecedorController::class, 'editar']) -> name('app.fornecedor.editar');
  Route::get('/fornecedor/excluir/{id}', [FornecedorController::class, 'excluir']) -> name('app.fornecedor.excluir');
  Route::get('/fornecedor/adicionar', [FornecedorController::class, 'adicionar']) -> name('app.fornecedor.adicionar');
  Route::post('/fornecedor/adicionar', [FornecedorController::class, 'adicionar']) -> name('app.fornecedor.adicionar');
  
  //produto
  Route::get('/produto', [ProdutoController::class, 'index']) -> name('app.produto');
  Route::get('/produto/adicionar', [ProdutoController::class, 'adicionar']) -> name('app.produto.adicionar');
  Route::post('/produto/adicionar', [ProdutoController::class, 'adicionar']) -> name('app.produto.adicionar');
  Route::get('/produto/listar', [ProdutoController::class, 'listar']) -> name('app.produto.listar');
  Route::get('/produto/editar/{id}/{msg?}', [ProdutoController::class, 'editar']) -> name('app.produto.editar');
  Route::get('/produto/excluir/{id}', [ProdutoController::class, 'excluir']) -> name('app.produto.excluir');

  //detalhes do produto
  Route::get('/produto/detalhe/adicionar/{id_produto?}', [ProdutoDetalheController::class, 'adicionar']) -> name('app.produto_detalhe.adicionar');
  Route::post('/produto/detalhe/adicionar', [ProdutoDetalheController::class, 'adicionar']) -> name('app.produto_detalhe.adicionar');
  Route::get('/produto/detalhe/listar/{id}', [ProdutoDetalheController::class, 'listar']) -> name('app.produto_detalhe');
  Route::get('/produto/detalhe/editar/{id}/{id_produto}/{msg?}', [ProdutoDetalheController::class, 'editar']) -> name('app.produto_detalhe.editar');
  Route::get('/produto/detalhe/excluir/{id}', [ProdutoDetalheController::class, 'excluir']) -> name('app.produto_detalhe.excluir');

  //unidades
  Route::get('/produto/unidade/listar', [UnidadeController::class, 'listar']) -> name('app.unidade.listar');
  Route::get('/produto/unidade/adicionar', [UnidadeController::class, 'adicionar']) -> name('app.unidade.adicionar');
  Route::post('/produto/unidade/adicionar', [UnidadeController::class, 'adicionar']) -> name('app.unidade.adicionar');
  Route::get('/produto/unidade/editar/{id}/{msg?}', [UnidadeController::class, 'editar']) -> name('app.unidade.editar');
  Route::get('/produto/unidade/excluir{id}', [UnidadeController::class, 'excluir']) -> name('app.unidade.excluir');

  //clientes
  Route::get('/cliente', [ClienteController::class, 'index']) -> name('app.cliente');
  Route::get('/cliente/cadastrar', [ClienteController::class, 'adicionar']) -> name('app.cliente.adicionar');
  Route::post('/cliente/cadastrar', [ClienteController::class, 'adicionar']) -> name('app.cliente.adicionar');
  Route::get('/cliente/listar', [ClienteController::class, 'listar']) -> name('app.cliente.listar');
  Route::get('/cliente/editar/{id}/{msg?}', [ClienteController::class, 'editar']) -> name('app.cliente.editar');
  Route::get('/cliente/excluir{id}', [ClienteController::class, 'excluir']) -> name('app.cliente.excluir');

  //pedidos
  Route::get('/pedido/listar', [PedidoController::class, 'listar']) -> name('app.pedido.listar');
  Route::get('/pedido/cadastrar', [PedidoController::class, 'adicionar']) -> name('app.pedido.adicionar');
  Route::post('/pedido/cadastrar', [PedidoController::class, 'adicionar']) -> name('app.pedido.adicionar');
  Route::get('/pedido/editar/{id}/{msg?}', [PedidoController::class, 'editar']) -> name('app.pedido.editar');
  Route::get('/pedido/excluir{id}', [PedidoController::class, 'excluir']) -> name('app.pedido.excluir');
  
  //pedido detalhe
  Route::get('/pedido/detalhe/listar/{id}/{ind_criar?}', [PedidoDetalheController::class, 'listar']) -> name('app.pedido_detalhe.listar');
  Route::get('/pedido/detalhe/adicionar/{pedido_id?}', [PedidoDetalheController::class, 'adicionar']) -> name('app.pedido_detalhe.adicionar');
  Route::post('/pedido/detalhe/adicionar', [PedidoDetalheController::class, 'adicionar']) -> name('app.pedido_detalhe.adicionar');
  Route::get('/pedido/detalhe/editar/{id}/{pedido_id?}/{msg?}', [PedidoDetalheController::class, 'editar']) -> name('app.pedido_detalhe.editar');
  Route::get('/pedido/detalhe/excluir/{id}/{pedido_id}', [PedidoDetalheController::class, 'excluir']) -> name('app.pedido_detalhe.excluir');
});

Route::fallback(function() {
  echo "Pagina acessada ainda não está disponivel. <a href=".route('site.index')."> Clique aqui</a> para ir a pagina inicial";
});