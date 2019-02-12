@php
    \Carbon\Carbon::setLocale('es');
    setlocale(LC_TIME, 'Spanish');
@endphp

@extends('dashboard.app')

@section('content')

    <section class="section section--main">

       {{--  <div class="tab">
            <button class="btn tablinks" onclick="openTab(event, 'Latest')">Recientes</button>
            <button class="btn tablinks" onclick="openTab(event, 'Following')">Siguiendo</button>
        </div>
 --}}

        @include('dashboard.forms.create-post')


        @if ($posts->count())

            <div id="Latest" class="section--posts">

                @foreach ($posts as $post)
                    @include('dashboard.posts')
                @endforeach
            </div><!-- Latest -->

            <div id="Following" class="tabcontent flex" style="justify-content:space-between;flex-wrap:wrap;align-items: flex-start;">

                @foreach ($posts_following as $post)
                    <div style="width:49%;background:white;padding:1em;margin:1em 0;border-radius:10px;" data-postid="{{$post->id}}">

                        <div class="flex">

                            <div class="flex">
                                <a href="/profile/{{$post->user->id}}">
                                    <img src="/uploads/avatars/{{ $post->user->avatar }}" alt="{{ $post->user->name }}" style="border-radius:50%;height:3em;object-fit:contain;">
                                </a>
                                <div>
                                    <a href="/profile/{{$post->user->id}}">{{$post->user->name}}</a>
                                    <p>{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            @if(Auth::user()->id == $post->user->id)
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            <i class="fas fa-ellipsis-h"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="/posts/{{$post->id}}/edit">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <a class="dropdown-item" href="{{ route('post.delete', [$post->id]) }}"
                                            onclick="event.preventDefault(); document.getElementById('delete-post').submit();">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </a>

                                            <form id="delete-post" action="{{ route('post.delete', [$post->id]) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            @endif

                        </div>

                        @if($post->image != '')
                            <img src="/uploads/posts/{{ $post->image }}" alt="Post image" style="width:100%;">
                        @endif

                        <p><strong>{{ $post->content }}</strong></p>

                        <div class="flex">
                            <div class="flex">

                                <a href="#" class="like button">
                                    <i class="far fa-heart"></i>
                                    @if ($post->likes != '0')
                                        <span>{{ $post->likes}}</span>
                                    @endif
                                    {{--  {{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'Dislike' : 'Like' : 'Like' }} --}}
                                </a>

                                <a href="#" class="button">
                                    <i class="far fa-comment"></i>
                                    @if ($post->comments->count())
                                        <span>{{ $post->comments->count() }}</span>
                                    @endif
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
                                    <button type="submit" class="button is-primary">Comentar</button>
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
            </div> <!-- Siguiendo -->

        @endif
    </section>

    <script type="text/javascript">
        var token = '{{ Session::token() }}';
        var urlLike = '{{ route('like') }}';

        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

    </script>
    <script src="{{ asset('js/like.js') }}"></script>


@endsection
