<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Super Gestão - @yield('titulo')</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/estilo_basico.css') }}"> {{-- Link do arquivo css --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}">
    <script src = "{{ asset('js/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</head>

<body>
     @yield('conteudo')   {{--pucha o conteudo lá da pagina que está sendo executada--}}
</body>

</html>
