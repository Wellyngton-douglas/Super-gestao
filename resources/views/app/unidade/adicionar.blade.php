@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')	
	
  <div class="conteudo-pagina">
		<div class="titulo-pagina-2">
			<p>Unidade - @yield('titulo')</p>
		</div>

		<div class="menu">
			<ul>
        <li><a href="{{ route('app.unidade.listar') }}">Cadastrados</a></li>
				<li><a href="{{ route('app.produto') }}">Voltar</a></li>
			</ul>
		</div>

		<div class="informação-pagina">
			<div style="width:30%; margin-left:auto; margin-right:auto;">
				{{ isset($msg) && $msg != '' ? $msg : ''}}
				<form action= {{ route('app.unidade.adicionar') }} method="post">
					@csrf
					<input name="id" value="{{ $unidade -> id ?? '' }}" type="hidden" class="borda-preta">
					<input name="unidade" value="{{ $unidade -> unidade ?? old('unidade') }}" type="text" placeholder="Unidade" class="borda-preta">
					{{ $errors->has('unidade') ? $errors->first('unidade') : '' }}
					<br>
					<input name="descricao" value="{{ $unidade -> descricao ?? old('descricao') }}" type="text" placeholder="Descrição" class="borda-preta">
					{{ $errors->has('descricao') ? $errors->first('descricao') : '' }}
					<br>
					<button type="submit" class="borda-preta">ADICIONAR</button>
				</form>			
			</div>
		</div>
	</div>
	
	@include('app.layouts._partials.rodape')
@endsection