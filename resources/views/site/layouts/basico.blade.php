<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Super Gestão - @yield('titulo')</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="{{ asset('css/style_web.css') }}">
  </head>

	<body>
    @include('site.layouts._partials.menu')
		@yield('conteudo')
	</body>
</html>