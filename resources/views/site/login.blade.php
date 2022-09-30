@extends('site.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')	
	<div class="conteudo-pagina">
		<div class="titulo-pagina">
			<h1>Login</h1>
		</div>

		<div class="informacao-pagina">
      <div style="width:30%; margin-left:auto; margin-right:auto;">
        <form action= {{ route('site.login') }} method="post">
          @csrf
          <input name="usuario" value="{{ old('usuario') }}" type="text" placeholder="Usúario" class="borda-preta">
          {{ $errors->has('usuario') ? $errors->first('usuario') : '' }}
          <br>
          <input name="senha" type="password" placeholder="Senha" class="borda-preta">
          {{ $errors->has('senha') ? $errors->first('senha') : '' }}
          <br>
          <button type="submit" class="borda-preta">Login</button>
        </form>
        {{ isset($erro) && $erro != '' ? $erro : ''}}
      </div>
		</div>  
	</div>
	
	@include('site.layouts._partials.rodape')
@endsection