@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')	
	
  <div class="conteudo-pagina">
		<div class="titulo-pagina-2">
			<p>Cliente - @yield('titulo')</p>
		</div>

		<div class="menu">
			<ul>
				<li><a href="{{ route('app.cliente.adicionar') }}">Novo</a></li>
				<li><a href="{{ route('app.cliente') }}">Consultar</a></li>
			</ul>
		</div>

		<div class="informação-pagina">
			<div style="width:30%; margin-left:auto; margin-right:auto;">
				{{ isset($msg) && $msg != '' ? $msg : ''}}
				<form action= {{ route('app.cliente.adicionar') }} method="post">
					@csrf
					<input name="id" value="{{ $cliente -> id ?? '' }}" type="hidden" class="borda-preta">
					<input name="nome" value="{{ $cliente -> nome ?? old('nome') }}" type="text" placeholder="Nome" class="borda-preta">
					{{ $errors->has('nome') ? $errors->first('nome') : '' }}
					<button type="submit" class="borda-preta">ADICIONAR</button>
				</form>			
			</div>
		</div>
	</div>
	
	@include('app.layouts._partials.rodape')
@endsection