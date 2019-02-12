

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title', 'Little Paws')</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href= "{{ asset('css/styles.css') }}" rel="stylesheet">

    </head>
    <body>

        <section class="section section--auth d-flex register">

            <div class="register__bg"></div>

            <div class="register__form">

                <a href="">Volver</a>

                <h1>Iniciar sesión</h1>

                <form method="POST" action="{{ route('login') }}" class="form">
                    @csrf

                    <div class="form-group">
                        <input id="email" type="email" placeholder="E-mail" class="form__input email {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <input id="password" type="password" placeholder="Contraseña" class="form__input pass {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
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
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                               ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>
                </form>

                <div class="">
                    ¿Aun no tenés cuenta? <a class="color-main" href="/register">Registrarme</a>
                </div>

            </div>
        </section>


    </body>
</html>

