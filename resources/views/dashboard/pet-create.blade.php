@extends('dashboard.app')

@section('content')
    <h1>Mi mascota</h1>

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
            <a href="" class="btn btn-primary">
                Cancelar
            </a>
        </div>
    </form>

@endsection
