@php
    \Carbon\Carbon::setLocale('es');
    setlocale(LC_TIME, 'Spanish');
@endphp

@extends('dashboard.app')

@section('content')

    <form method="POST" action="/home">
        @csrf

        <div class="field">
            <label class="label" for="content">Crear publicación</label>

            <div class="control">
                <textarea class="textarea {{ $errors->has('content') ? 'is-danger' : '' }}" name="content" id="content" cols="30" rows="5"></textarea>
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
    </form>

    @if ($posts->count())
        <div>
            @foreach ($posts as $post)
                <div style="background:white;padding:1em;margin:1em 0;border-radius:10px;" data-postid="{{$post->id}}">
                    <a href="/profile/{{$post->user->id}}">{{$post->user->name}}</a>
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
        </div>
    @endif

    <script type="text/javascript">
        var token = '{{ Session::token() }}';
        var urlLike = '{{ route('like') }}';
    </script>
    <script src="{{ asset('js/like.js') }}"></script>


@endsection
