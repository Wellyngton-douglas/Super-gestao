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

		<div class="informação-pagina">
			<div style="width:30%; margin-left:auto; margin-right:auto;">
				{{ isset($msg) && $msg != '' ? $msg : ''}}
				<form action= {{ route('app.fornecedor.adicionar') }} method="post">
					@csrf
					<input name="id" value="{{ $fornecedor -> id ?? '' }}" type="hidden" class="borda-preta">
					<input name="nome" value="{{ $fornecedor -> nome ?? old('nome') }}" type="text" placeholder="Nome" class="borda-preta">
					{{ $errors->has('nome') ? $errors->first('nome') : '' }}
					<br>
					<input name="site" value="{{ $fornecedor -> site ?? old('site') }}" type="text" placeholder="Site" class="borda-preta">
					{{ $errors->has('site') ? $errors->first('site') : '' }}
					<br>
					<select name="estados_id" class="borda-preta">
						<option value="">Localidade do fornecedor</option>
						@foreach ($estados as $key => $estado)
							<option value="{{ $estado -> id }}" {{ ($fornecedor -> estados_id ?? old('estados_id')) == $estado -> id ? 'selected' : '' }}>{{ $estado -> uf}}</option>
						@endforeach
					</select>
					{{ $errors->has('estados_id') ? $errors->first('estados_id') : '' }}
					<br>
					<input name="email" value="{{ $fornecedor -> email ?? old('email') }}" type="text" placeholder="E-mail" class="borda-preta">
					{{ $errors->has('email') ? $errors->first('email') : '' }}
					<br>
					<button type="submit" class="borda-preta">ADICIONAR</button>
				</form>			
			</div>
		
		</div>
	</div>
	
	@include('app.layouts._partials.rodape')
@endsection