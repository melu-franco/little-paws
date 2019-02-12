<div class="post-card main-wrapper" data-postid="{{$post->id}}">

        <div class="d-flex w-pad">

            <div class="post-card__user d-flex flex-ai-center ">
                <a href="/profile/{{$post->user->id}}">
                    <img src="/uploads/avatars/{{ $post->user->avatar }}" alt="{{ $post->user->name }}" style="border-radius:50%;height:3em;object-fit:contain;">
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
                            <i class="material-icons color-gray">more_horizontal</i>
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
            @if($post->image != '')
                <img src="/uploads/posts/{{ $post->image }}" alt="Post image" style="width:100%;">
            @endif

            <p class="w-pad">{{ $post->content }}</p>

       </div>
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

        @if ($post->comments->count())
            @foreach($post->comments as $comment)
                <div class="display-comment" style="padding-left:5%;padding-top:1em;border-top:1px solid #ccc;">
                    <div class="flex">
                        <a href="/profile/{{$comment->user->id}}">
                            <img src="/uploads/avatars/{{ $comment->user->avatar }}" alt="{{ $comment->user->name }}" style="border-radius:50%;height:2em;object-fit:contain;">
                        </a>
                        <div>
                            <a href="/profile/{{$comment->user->id}}">
                                <strong>{{$comment->user->name}}</strong>
                            </a>
                            <p>{{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <p>{{ $comment->content }}</p>

                    @if ( Auth::user()->id == $comment->user->id)
                        <form method="POST" action="/comment/{{$comment->id}}">
                            @method('DELETE')
                            @csrf
                            <div class="field">
                                <div class="control">
                                    <button type="submit" class="button is-light">Eliminar</button>
                                </div>
                            </div>
                        </form>
                    @endif

                </div>
            @endforeach
        @endif

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

    </div>
