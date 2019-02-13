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

        <!-- Styles -->
        <link href= "{{ asset('css/styles.css') }}" rel="stylesheet">

    </head>
    <body>
        
        <section class="section section--auth d-flex pet-create">

            <div class="auth-bg pet-create__bg"></div>

            <div class="auth-content pet-create__form">
                <div class="align-center">
                    <h1>Agregar mascota</h1>
        
                    <form method="POST" class="form" action="{{ route('pet.store') }}" enctype="multipart/form-data">
                        @csrf
        
                        <div class="field">
                            <p>Tipo de mascota</p>
                            <div class="control">
                                @foreach ($pet_types as $pet)
                                    <label for="pet-{{$pet->id}}">{{$pet->title}}</label>
                                    <input type="radio" name="pet_type_id" value="{{$pet->id}}" id="pet-{{$pet->id}}">
                                @endforeach
                            </div>
                        </div>
        
                        <div class="field">
                                <label for="avatar" class="label">{{ __('Avatar (optional)') }}</label>
        
                                <div class="control">
                                    <input id="avatar" type="file" class="form-control" name="avatar">
                                </div>
                            </div>
        
                        <div class="field">
                            <label for="name" class="label">Nombre</label>
        
                            <div class="control">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                            </div>
        
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
        
                        <div class="field">
                            <label class="label" for="description">Info</label>
        
                            <div class="control">
                                <textarea class="textarea {{ $errors->has('content') ? 'is-danger' : '' }}" name="description" id="description" cols="30" rows="5"></textarea>
                            </div>
                            @if ($errors->has('description'))
                                @foreach ($errors->all() as $error)
                                    <p class="help is-danger">{{ $error }}</p>
                                @endforeach
                            @endif
                        </div>
        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Crear
                            </button>
                        </div>
        
                        <div class="form-group">
                            <a href="{{ URL::previous() }}" class="btn btn-primary">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </body>
</html>