@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')	
	
  <div class="conteudo-pagina">
		<div class="titulo-pagina-2">
			<p>Unidade - @yield('titulo')</p>
		</div>

		<div class="menu">
			<ul>
				<li><a href="{{ route('app.unidade.adicionar') }}">Novo</a></li>
				<li><a href="{{ route('app.produto') }}">Voltar</a></li>
			</ul>
		</div>
		<div>
		<div>
			<h4>{{ session()->get('msg') }}</h4>
		</div>
		</div>
		<div class="informação-pagina">
			<div class="contato-principal">
				<table class="table table-bordered data-table">
					<thead>
						<tr>
							<th>Unidade</th>
							<th>Descrição</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($unidades as $unidade)						
							<tr>
								<td>{{ $unidade -> unidade}}</td>
								<td>{{ $unidade -> descricao}}</td>
								<td><a href="{{ route('app.unidade.excluir', $unidade -> id) }}">Excluir</a></td>
								<td><a href="{{ route('app.unidade.editar', $unidade -> id) }}">Editar</a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="pagination justify-content-center">
					{{ $unidades -> links() }}
				</div>
			</div>
		</div>
	</div>
	
	@include('app.layouts._partials.rodape')
@endsection