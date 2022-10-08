@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')	
  <div class="conteudo-pagina">
		<div class="titulo-pagina-2">
			<p>Fornecedor - @yield('titulo')</p>
		</div>

		<div class="menu">
			<ul>
				<li><a href="{{ route('app.fornecedor.listar') }}">Voltar</a></li>
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
							<th>Usúario</th>
							<th>Data de criação</th>
							<th>Data de Alteração</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($historicos as $historico)						
							<tr>
								<td>{{ $historico -> name}}</td>
								<td>{{ $historico -> created_at}}</td>
								<td>{{ $historico -> updated_at}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="pagination justify-content-center">
					{{ $historicos -> links() }}
				</div>
			</div>
		</div>
	</div>
  
	
	@include('app.layouts._partials.rodape')
@endsection