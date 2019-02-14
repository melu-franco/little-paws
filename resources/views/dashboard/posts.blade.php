<div class="post-card main-wrapper" data-postid="{{$post->id}}">

        <div class="d-flex w-pad">

            <div class="post-card__user d-flex flex-ai-center ">
                <a href="/profile/{{$post->user->id}}" class="avatar">
                    <img src="/uploads/avatars/{{ $post->user->avatar }}" alt="{{ $post->user->name }}">
                </a>
                <div class="post-card__user__info">
                    <a class="owner" href="/profile/{{$post->user->id}}">{{$post->user->name}}</a>
                    <p class="time">{{ $post->created_at->diffForHumans() }}</p>
                </div>
            </div>

            @if(Auth::user()->id == $post->user->id)
                <ul class="navbar-nav ml-auto post-card__edit">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="material-icons -color-gray">more_horizontal</i>
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

       <div class="post-card__content">

            <p class="w-pad">{{ $post->content }}</p>

            @if($post->image != '')
                <img src="/uploads/posts/{{ $post->image }}" alt="Post image" style="width:100%;">
            @endif

       </div>
        <div class="d-flex post-card__reactions border-top">
            <a href="#" class="like btn-reaction">
                <i class="far fa-heart"></i>
                <span>Like</span>
                @if ($post->likes != '0')
                    <span>{{ $post->likes}}</span>
                @endif
                {{--  {{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'Dislike' : 'Like' : 'Like' }} --}}
            </a>

            <a href="#" class="btn-reaction">
                <i class="far fa-comment"></i>
                <span>Comentar</span>
                @if ($post->comments->count())
                    <span>{{ $post->comments->count() }}</span>
                @endif
                {{--  {{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'Dislike' : 'Like' : 'Like' }} --}}
            </a>

            <a href="#" class="btn-reaction">
                <i class="material-icons">share</i>
                <span>Compartir</span>
            </a>
        </div>

        <form method="post" class="form form--comment" action="{{ route('comment.add') }}">
            @csrf
            <div class="form-group d-flex w-pad border-top flex-ai-center">
                <a href="/profile/{{Auth::user()->id}}" class="avatar">
                    <img src="/uploads/avatars/{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" style="">
                </a>
                <textarea class="no-border {{ $errors->has('content') ? 'is-danger' : '' }}" name="content" placeholder="Escribí un comentario.." id="content" cols="30"></textarea>
                <input type="hidden" name="post_id" value="{{ $post->id }}" />

                <button type="submit" class="btn"><i class="material-icons -color-green">send</i></button>
            </div>
        </form>

        @if ($post->comments->count())
            @foreach($post->comments as $comment)
                <div class="comment w-pad border-top">
                    <div class="d-flex">
                        <div class="d-flex">
                            <a href="/profile/{{$comment->user->id}}" class="avatar">
                                <img src="/uploads/avatars/{{ $comment->user->avatar }}" alt="{{ $comment->user->name }}" style="border-radius:50%;height:2em;object-fit:contain;">
                            </a>
                            <div class="comment__user__info">
                                <a class="owner" href="/profile/{{$comment->user->id}}">{{$comment->user->name}}</a>
                                <p class="time">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        @if (Auth::user()->id == $comment->user->id)
                        <ul class="navbar-nav ml-auto post-card__edit">
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="material-icons -color-gray">more_horizontal</i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('comment.delete', [$comment->id]) }}"
                                        onclick="event.preventDefault(); document.getElementById('delete-comment').submit();">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </a>

                                        <form id="delete-comment" action="{{ route('comment.delete', [$comment->id]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        @endif

                    </div>
                    <p class="comment__p">{{ $comment->content }}</p>


                </div>
            @endforeach
        @endif

    </div>
