@extends('dashboard.app')

@section('content')
    <h1>Editar</h1>
    <img src="/uploads/avatars/{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" style="border-radius:50%;height:5em;object-fit:contain;">

    <form method="POST" action="/profile/{{ $user->id }}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf

        <div class="field">
            <label for="avatar" class="button"><i class="fas fa-pen"></i></label>

            <div class="col-md-6">
                <input id="avatar" type="file" name="avatar" onChange="this.form.submit()" style="visibility:hidden;display:none;" class="input form-control {{ $errors->has('content') ? 'is-danger' : '' }}">
            </div>
            @if ($errors->has('name'))
                @foreach ($errors->all() as $error)
                    <p class="help is-danger">{{ $error }}</p>
                @endforeach
            @endif
        </div>
    </form>

    <form method="POST" action="/profile/{{ $user->id }}" class="is-pulled-left"  enctype="multipart/form-data">
        @method('DELETE')
        @csrf
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-light"><i class="fas fa-trash-alt"></i></button>
            </div>
        </div>
    </form>

    <div class="is-clearfix"></div>

    <form method="POST" action="/profile/{{ $user->id }}">
        @method('PATCH')
        @csrf

        <div class="field">
            <label class="label" for="name">Editar nombre</label>

            <div class="control">
                <input type="text" class="input {{ $errors->has('content') ? 'is-danger' : '' }}" name="name" id="name" value="{{ $user->name }}">
            </div>
            @if ($errors->has('name'))
                @foreach ($errors->all() as $error)
                    <p class="help is-danger">{{ $error }}</p>
                @endforeach
            @endif
        </div>

        <div class="field">
            <label class="label" for="description">Editar descripción</label>

            <div class="control">
                <textarea class="textarea {{ $errors->has('content') ? 'is-danger' : '' }}" name="description" id="description" cols="30" rows="10">{{ $user->description }}</textarea>
            </div>
            @if ($errors->has('description'))
                @foreach ($errors->all() as $error)
                    <p class="help is-danger">{{ $error }}</p>
                @endforeach
            @endif
        </div>

        <div class="field is-pulled-left">
            <div class="control">
                <button type="submit" class="button is-primary">Guardar</button>
            </div>
        </div>
    </form>

    <div class="is-pulled-left">
        <a href="{{ URL::previous() }}" class="button is-dark">Cancelar</a>
    </div>

    <div class="is-clearfix"></div>

    <form method="POST" action="/profile/{{ $user->id }}" class="is-pulled-left">
        @method('DELETE')
        @csrf

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-light">Eliminar cuenta</button>
            </div>
        </div>
    </form>

@endsection
