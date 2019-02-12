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

                <h1>Crear cuenta</h1>

                <form method="POST" action="{{ route('register') }}" class="form" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group avatar">
                        <label for="avatar" class="">Avatar (opcional)</label>
                        <input id="avatar" type="file" class="" name="avatar">

                        <p>Cambiar imagen</p>

                        @if ($errors->has('avatar'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('avatar') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input id="name" type="text" placeholder="Nombre" class="form__input user {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input id="email" type="email" placeholder="E-mail" class="form__input email{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" placeholder="Contraseña" class="form__input pass{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input id="password-confirm" type="password" placeholder="Repetir contraseña" class="form__input pass-confirm{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>

                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Crear
                        </button>
                    </div>
                </form>

                <div class="">
                    ¿Ya tenés cuenta? <a class="color-main" href="/login">Login</a>
                </div>

            </div>
        </section>


    </body>
</html>

