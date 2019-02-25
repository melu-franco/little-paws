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

        <section class="section section--auth d-flex pet-create">

            <div class="auth-content pet-create__form">
                <div class="align-center">
                    <h1 class="section--auth__title">Agregar mascota</h1>

                    <form method="POST" class="form" action="{{ route('pet.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group pets">
                            <h2 class="title title--medium -mayus">Tipo de mascota</h2>
                            <div class="control d-flex flex-wrap">
                                @foreach ($pet_types as $pet)
                                    <input class="hidden" type="radio" name="pet_type_id" value="{{$pet->id}}" id="pet-{{$pet->id}}">
                                    <label class="pet pet-{{$pet->id}}" for="pet-{{$pet->id}}">
                                        <img src="/img/pets_avatars/{{$pet->avatar}}" alt="{{$pet->title}}">
                                        {{$pet->title}}
                                    </label>
                                @endforeach
                            </div>
                            @if ($errors->has('pet_type_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pet_type_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <h2 class="title title--medium -mayus">Completar datos</h2>

                        <div class="form-group avatar">
                            <div class="setting image_picker">
                                <div class="settings_wrap d-flex">
                                    <label class="drop_target">
                                        <div class="image_preview"></div>
                                        <input id="inputFile" name="avatar" type="file"/>
                                    </label>
                                    <div class="settings_actions vertical">
                                        <label for="inputFile" class="choose-file"><i class="fa fa-picture-o"></i> Subir archivo</label>
                                        <a class="disabled" data-action="remove_current_image"><i class="fa fa-ban"></i> <span>Eliminar archivo</span></a>
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

                            <input id="name" type="text" placeholder="Nombre *" class="form__input user {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="label-icon" for="description"><i class="material-icons">create</i></label>

                            <div class="control">
                                <textarea class="form__textarea {{ $errors->has('content') ? 'is-danger' : '' }}" placeholder="Descripción.." name="description" id="description" cols="30" rows="5"></textarea>
                            </div>
                            @if ($errors->has('description'))
                                @foreach ($errors->all() as $error)
                                    <p class="help is-danger">{{ $error }}</p>
                                @endforeach
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-round -large -blue">
                                Crear
                            </button>
                        </div>

                        <div class="form-group">
                            <a href="{{ URL::previous() }}" class="link -color-blue">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="auth-bg pet-create__bg"></div>

        </section>

    </body>
</html>
