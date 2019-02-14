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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

        <!-- Styles -->
        <link href= "{{ asset('css/styles.css') }}" rel="stylesheet">

    </head>
    <body>

        <section class="section section--auth d-flex register">

            <div class="auth-bg register__bg"></div>

            <div class="auth-content register__form">

                <a class="link link--back d-flex" href="{{ URL::previous() }}">Volver</a>

               <div class="align-center">
                    <h1 class="section--auth__title -color-blue">Crear cuenta</h1>
                    <p class="section--auth__desc -color-gray">Completá el formulario</p>

                    <form method="POST" action="{{ route('register') }}" class="form -blue" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group avatar">
                            <div class="setting image_picker">
                                <div class="settings_wrap d-flex">
                                    <label class="drop_target">
                                        <div class="image_preview"></div>
                                        <input id="inputFile" name="avatar" type="file"/>
                                    </label>
                                    <div class="settings_actions vertical">
                                        <label for="inputFile" class="choose-file"><i class="fa fa-picture-o"></i> Subir archivo</label>
                                        <a class="disabled" data-action="remove_current_image"><i class="fa fa-ban"></i> Eliminar archivo</a>
                                    </div>
                                </div>
                            </div>

                            @if ($errors->has('avatar'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('avatar') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="name" class="label-icon"><i class="material-icons">person</i></label>

                            <input id="name" type="text" placeholder="Nombre" class="form__input user {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email" class="label-icon"><i class="material-icons">mail</i></label>

                            <input id="email" type="email" placeholder="E-mail" class="form__input email{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password" class="label-icon"><i class="material-icons">lock</i></label>

                            <input id="password" type="password" placeholder="Contraseña" class="form__input pass{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="label-icon"><i class="material-icons">lock</i></label>

                            <input id="password-confirm" type="password" placeholder="Repetir contraseña" class="form__input pass-confirm{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation">

                            @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-round -large -blue">
                                Crear
                            </button>
                        </div>
                    </form>

                    <div class="auth-redirect">
                        ¿Ya tenés cuenta? <a class="-color-red" href="/login">Login</a>
                    </div>
               </div>

            </div>
        </section>


    </body>
</html>

