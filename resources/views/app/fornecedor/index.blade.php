@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')	
	
  <div class="conteudo-pagina">
		<div class="titulo-pagina-2">
			<p>Fornecedor</p>
		</div>

		<div class="menu">
			<ul>
				<li><a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></li>
				<li><a href="{{ route('app.fornecedor') }}">Consultar</a></li>
			</ul>
		</div>

		<div class="informação-pagina">
			<div style="width:30%; margin-left:auto; margin-right:auto;">
				{{ isset($erro) && $erro != '' ? $erro : ''}}
				<form action= {{ route('app.fornecedor.listar') }} method="post">
					@csrf
					<input name="nome" value="{{ old('nome') }}" type="text" placeholder="Nome" class="borda-preta">
					<br>
					<input name="site" value="{{ old('site') }}" type="text" placeholder="Site" class="borda-preta">
					<br>
					<select name="estados_id" class="borda-preta">
						<option value="">Localidade do fornecedor</option>
						@foreach ($estados as $key => $estado)
							<option value="{{ $estado -> id }}" {{ old('estados_id') == $estado -> id ? 'selected' : '' }}>{{ $estado -> uf}}</option>
						@endforeach
					</select>
					<br>
					<input name="email" value="{{ old('email') }}" type="text" placeholder="E-mail" class="borda-preta">
					<br>
					<button type="submit" class="borda-preta">LISTAR</button>
				</form>
			</div>
		</div>
	</div>
	
	@include('app.layouts._partials.rodape')
@endsection