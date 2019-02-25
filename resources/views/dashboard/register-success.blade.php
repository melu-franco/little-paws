<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title', 'Little Paws')</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

        <!-- Styles -->
        <link href= "{{ asset('css/styles.css') }}" rel="stylesheet">

    </head>
    <body>

        <section class="section section--auth d-flex register-success">

            <div class="auth-bg register-success__bg"></div>

            <div class="auth-content register-success__content">
                <div class="align-center">
                    <div class="done">
                        <i class="material-icons -color-red">done</i>
                    </div>
                    <h1 class="section--auth__title">
                        Usuario registrado
                    </h1>

                    <a href="{{route('pet.create')}}" class="btn btn-round -large -red">Agregar perfil de mascota</a>

                    <a href="/home" class="btn btn-round -large -blue">Ir a la home</a>
                </div>
            </div>

        </section>

  </body>
</html>

