<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Sistema Ventas Laravel Vue Js- IncanatoIT">
        <meta name="author" content="Incanatoit.com">
        <meta name="keyword" content="Sistema ventas Laravel Vue Js, Sistema compras Laravel Vue Js">
        <link rel="shortcut icon" href="img/favicon.png">
        <title>Sistema Ventas - IncanatoIT</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Icons -->
        <link href="{{ asset('css/plantilla.css') }}" rel="stylesheet">
    </head>

    <body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
        <div id="app">
            <navbar></navbar>
            <div class="app-body">
                <sidebar></sidebar>
                <router-view></router-view>
            </div>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/plantilla.js') }}"></script>
    </body>

</html>
