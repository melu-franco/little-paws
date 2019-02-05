@php
    \Carbon\Carbon::setLocale('es');
    setlocale(LC_TIME, 'Spanish');
@endphp

@extends('dashboard.app')

@section('content')


    <a href="/profile/{{Auth::user()->id}}">
        <img src="/uploads/avatars/{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" style="border-radius:50%;height:3em;object-fit:contain;">
    </a>

    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
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
        <div class="flex" style="justify-content:space-between;flex-wrap:wrap;align-items: flex-start;">
            @foreach ($posts as $post)
                <div style="width:49%;background:white;padding:1em;margin:1em 0;border-radius:10px;" data-postid="{{$post->id}}">
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
                        <div class="flex">
                            @if ($post->likes != '0')
                                <p>{{ $post->likes}}</p>
                            @endif
                            <a href="#" class="like">
                                <i class="far fa-heart"></i>
                               {{--  {{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'Dislike' : 'Like' : 'Like' }} --}}
                            </a>
                        </div>
                    </div>

                    <form method="post" action="{{ route('comment.add') }}">
                        @csrf
                        <div class="field">
                            <input type="text" name="content" placeholder="Escribir un comentario" class="input form-control" />
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        </div>
                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-primary">Enviar comentario</button>
                            </div>
                        </div>
                    </form>

                    @if ($post->comments->count())
                        @foreach($post->comments as $comment)
                            <div class="display-comment" style="padding-left:5%;padding-top:1em;border-top:1px solid #ccc;">
                                <div class="flex">
                                    <a href="/profile/{{$comment->user->id}}">
                                        <img src="/uploads/avatars/{{ $comment->user->avatar }}" alt="{{ $comment->user->name }}" style="border-radius:50%;height:3em;object-fit:contain;">
                                    </a>
                                    <div>
                                        <a href="/profile/{{$comment->user->id}}">
                                            <strong>{{$comment->user->name}}</strong>
                                        </a>
                                        <p>{{ $comment->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <p>{{ $comment->content }}</p>

                                <form method="POST" action="/comment/{{$comment->id}}">
                                    @method('DELETE')
                                    @csrf
                                    <div class="field">
                                        <div class="control">
                                            <button type="submit" class="button is-light">Eliminar</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        @endforeach
                    @endif

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
