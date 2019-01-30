@extends('dashboard.app')

@section('content')
    <h1>Editar post</h1>

    <form method="POST" action="/posts/{{ $post->id }}">
        @method('PATCH')
        @csrf

        <div class="field">
            <label class="label" for="content">Escribi un comentario</label>

            <div class="control">
                <textarea class="textarea {{ $errors->has('content') ? 'is-danger' : '' }}" name="content" id="content" cols="30" rows="10">{{ $post->content }}</textarea>
            </div>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="help is-danger">{{ $error }}</p>
                @endforeach
            @endif
        </div>

        <div class="field is-pulled-left">
            <div class="control">
                <button type="submit" class="button is-primary">Post</button>
            </div>
        </div>
    </form>

    <form method="POST" action="/posts/{{ $post->id }}" class="is-pulled-left">
        @method('DELETE')
        @csrf

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-light">Borrar</button>
            </div>
        </div>
    </form>

    <div class="is-pulled-left">
        <a href="{{ URL::previous() }}" class="button is-dark">Cancelar</a>
    </div>

    <div class="is-clearfix"></div>

@endsection
