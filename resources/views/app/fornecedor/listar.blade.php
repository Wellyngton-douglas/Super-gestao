@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')	
	
  <div class="conteudo-pagina">
		<div class="titulo-pagina-2">
			<p>Fornecedor - @yield('titulo')</p>
		</div>

		<div class="menu">
			<ul>
				<li><a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></li>
				<li><a href="{{ route('app.fornecedor') }}">Consultar</a></li>
			</ul>
		</div>
		<div>
			<h1>{{ session()->get('msg') }}</h1>
		</div>
		<div class="informação-pagina">
			<div style="width:90%; margin-left:auto; margin-right:auto;">
				<table class="table table-bordered data-table">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Site</th>
							<th>UF</th>
							<th>E-mail</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($fornecedores as $fornecedor)						
							<tr>
								<td>{{ $fornecedor -> nome}}</td>
								<td>{{ $fornecedor -> site}}</td>
								<td>{{ $fornecedor -> uf}}</td>
								<td>{{ $fornecedor -> email}}</td>
								<td><a href="{{ route('app.fornecedor.excluir', $fornecedor -> id) }}">Excluir</a></td>
								<td><a href="{{ route('app.fornecedor.editar', $fornecedor -> id) }}">Editar</a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="pagination justify-content-center">
					{{ $fornecedores -> appends($request) -> links() }}
				</div>
			</div>
		</div>
	</div>
	
	@include('app.layouts._partials.rodape')
@endsection