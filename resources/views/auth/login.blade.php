

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

        <section class="section section--auth d-flex login">

            <div class="auth-bg login__bg"></div>

            <div class="auth-content login__form">

                <a class="link link--back d-flex" href="{{ URL::previous() }}"><i class="far fa-arrow-alt-circle-left visible-sm"></i><span class="hidden-sm">Volver</span></a>

                <div class="align-center">

                    <h1 class="section--auth__title -color-red">Iniciar sesión</h1>

                    <form method="POST" action="{{ route('login') }}" class="form -red">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="label-icon"><i class="material-icons">mail</i></label>
                            <input id="email" type="email" placeholder="E-mail*" class="form__input email {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password" class="label-icon"><i class="material-icons">lock</i></label>
                            <input id="password" type="password" placeholder="Contraseña*" class="form__input pass {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input form__input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label form__label" for="remember">
                                    Recordarme
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-round -large -red">
                                Login
                            </button>


                        </div>
                    </form>

                    <div class="auth-redirect">
                        ¿Aun no tenés cuenta? <a class="-color-blue" href="/register">Registrarme</a>
                    </div>
                </div>

            </div>
        </section>


    </body>
</html>

