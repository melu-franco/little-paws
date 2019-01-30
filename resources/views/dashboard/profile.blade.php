@php
    \Carbon\Carbon::setLocale('es');
    setlocale(LC_TIME, 'Spanish');
@endphp

@extends('dashboard.app')

@section('content')
    <h1>{{ $user->name }}</h1>

    <p>{{ $user->description }}</p>

    @if(Auth::user()->id == $user->id)
        <a href="/profile/{{$user->id}}/edit">Editar perfil</a>
    @endif

    {{-- <form method="POST" action="/home">
        @csrf

        <div class="field">
            <label class="label" for="content">Escribi un comentario</label>

            <div class="control">
                <textarea class="textarea {{ $errors->has('content') ? 'is-danger' : '' }}" name="content" id="content" cols="30" rows="10"></textarea>
            </div>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="help is-danger">{{ $error }}</p>
                @endforeach
            @endif
        </div>
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-primary">Post</button>
            </div>
        </div>
    </form> --}}

    @if ($user->posts->count())
        @foreach ($user->posts as $post)
            <div style="background:white;padding:1em;margin:1em 0;border-radius:10px;">
                <a href="/profile/{{$user->id}}">{{$user->name}}</a>
                <p>{{ $post->content }}</p>
                <p>{{ $post->created_at->diffForHumans() }}</p>
                <div class="flex">
                        @if(Auth::user()->id == $post->user->id)
                            <a href="/posts/{{$post->id}}/edit">Editar</a>
                            <span>|</span>
                        @endif
                        <a href="#">Comentar</a>
                        <span>|</span>
                        <div class="flex">
                            <p>{{ $post->likes}}</p>
                            <a href="#" class="like">
                                <i class="fas fa-paw"></i>
                                {{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'Dislike' : 'Like' : 'Like' }}
                            </a>
                        </div>
                    </div>
            </div>
        @endforeach
    @endif

@endsection
