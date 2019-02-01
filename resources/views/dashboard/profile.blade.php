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

    <form method="POST" action="/profile/{user}/posts" enctype="multipart/form-data">
        @csrf

        <div class="field">

            <div class="control">
                <textarea class="textarea {{ $errors->has('content') ? 'is-danger' : '' }}" name="content" placeholder="Crear publicación" id="content" cols="30" rows="5"></textarea>
            </div>

            <div class="field">
                <label for="image" class="button"><i class="fas fa-image"></i> Foto</label>

                <div class="col-md-6">
                    <input id="image" type="file" name="image" class="input form-control">
                </div>
            </div>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="help is-danger">{{ $error }}</p>
                @endforeach
            @endif
        </div>
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-primary">Compartir</button>
            </div>
        </div>
    </form>

    @if ($posts->count())
        @foreach ($posts as $post)
            <div style="background:white;padding:1em;margin:1em 0;border-radius:10px;">

                <div class="flex">
                    <a href="/profile/{{$post->user->id}}">
                        <img src="/uploads/avatars/{{ $post->user->avatar }}" alt="{{ $post->user->name }}" style="border-radius:50%;height:3em;object-fit:contain;">
                    </a>
                    <div>
                        <a href="/profile/{{$post->user->id}}">{{$post->user->name}}</a>
                        <p>{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                @if($post->image != '')
                    <img src="/uploads/posts/{{ $post->image }}" alt="Post image" style="width:100%;">
                @endif

                <p>{{ $post->content }}</p>

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
