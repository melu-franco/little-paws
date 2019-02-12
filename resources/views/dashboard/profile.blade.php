@php
    \Carbon\Carbon::setLocale('es');
    setlocale(LC_TIME, 'Spanish');
@endphp

@extends('dashboard.app')

@section('content')

    <div class="cover" style="height:16rem;width:100%;margin-bottom:2em;{{ $user->cover != '' ? "background-image:url('/uploads/covers/$user->cover');" : 'background-color:#aaa;'}}background-repeat:no-repeat;background-size:cover;">

        @if(Auth::user()->id == $user->id)
            <form method="POST" action="/profile/{{ $user->id }}/update_cover" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <div class="field">
                    <label for="cover" class="button"><i class="fas fa-pen"></i></label>

                    <div class="col-md-6">
                        <input id="cover" type="file" name="cover" onChange="this.form.submit()" style="visibility:hidden;display:none;" class="input form-control">
                    </div>
                </div>
            </form>

            @if($user->cover != '')
                <form method="POST" action="/profile/{{ $user->id }}/delete_cover" class="is-pulled-left" enctype="multipart/form-data">
                    @method('DELETE')
                    @csrf
                    <div class="field">
                        <div class="control">
                            <button type="submit" class="button is-light"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                </form>
            @endif

            @if ($errors->has('cover'))
                @foreach ($errors->all() as $error)
                    <p class="help is-danger">{{ $error }}</p>
                @endforeach
            @endif

        @else

            @if(Auth::user()->is_following($user->id))
                <form method="post" action="{{ route('user.unfollow', $user->id) }}" >
                    @csrf
                    <div class="field">
                        <div class="control">
                            <button type="submit" class="button is-light">Unfollow</button>
                        </div>
                    </div>
                </form>
            @else
                <form method="post" action="{{ route('user.follow', $user->id) }}" >
                    @csrf
                    <div class="field">
                        <div class="control">
                            <button type="submit" class="button is-light">Follow</button>
                        </div>
                    </div>
                </form>
            @endif

        @endif

    </div>

    <div class="section--pets pets">
        <h2 class="title title--medium">Pet List</h2>
        <div class="pets__list flex">
            <a href="" class="pet__list__item add"><i class="material-icons">add</i></a>
            @foreach ($pets as $pet)
                <a href="" class="pet__list__item">
                    <img src="{{$pet->avatar}}" alt="{{$pet->name}}" style="height:5em;">
                </a>
            @endforeach
        </div>
    </div>


    <div>
        <img src="/uploads/avatars/{{ $user->avatar }}" alt="{{ $user->name }}" style="border-radius:50%;height:6em;object-fit:contain;">
    </div>

    <h1>{{ $user->name }}</h1>

    <p>{{ $user->description }}</p>

    <p><strong>Seguidores</strong> {{$user->followers->count()}}</p>
    <p><strong>Siguiendo</strong> {{$user->following->count()}}</p>

    @if(Auth::user()->id == $user->id)
        <a href="/profile/{{$user->id}}/edit">Editar perfil</a>

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

    @endif

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
                    <div class="flex">
                        <p>{{ $post->likes}}</p>
                        <a href="#" class="like">
                            <i class="fas fa-paw"></i>
                            {{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'Dislike' : 'Like' : 'Like' }}
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
    @endif

@endsection
