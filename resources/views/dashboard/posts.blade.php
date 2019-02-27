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
                            <a class="dropdown-item" href="javascript.void(0);" data-toggle="modal" data-target="#editPostModal">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a class="dropdown-item" href="javascript.void(0);" data-toggle="modal" data-target="#deletePostModal">
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
            @if($post->content != '')
                <p class="w-pad">{{ $post->content }}</p>
            @endif

            @if($post->image != '')
                <img src="/uploads/posts/{{ $post->image }}" alt="Post image" style="width:100%;">
            @endif

       </div>
        <div class="d-flex post-card__reactions border-top">

            @if (Auth::user()->likes->where('post_id', $post->id)->count())
                <a href="{{ route('dislike', [Auth::user()->likes()->where('post_id', $post->id)->first()]) }}"
                onclick="event.preventDefault();
                                document.getElementById('dislike-form').submit();" class="btn-reaction">
                    <i class="fas fa-heart -color-red "></i>
                    <span class="hidden-sm">Like</span>
                    @if($post->likes->count())
                        <span class="visible-sm">{{$post->likes->count()}}</span>
                    @endif
                    {{--  {{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'Dislike' : 'Like' : 'Like' }} --}}
                </a>

                <form id="dislike-form" action="{{ route('dislike', [Auth::user()->likes()->where('post_id', $post->id)->first()]) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            @else
                <a href="{{ route('like') }}"
                onclick="event.preventDefault();
                                document.getElementById('like-form').submit();" class="like btn-reaction">
                    <i class="far fa-heart"></i>
                    <span class="hidden-sm">Like</span>
                    @if($post->likes->count())
                        <span class="visible-sm">{{$post->likes->count()}}</span>
                    @endif
                </a>

                <form id="like-form" action="{{ route('like') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}" />
                </form>
            @endif

            <a href="#" class="btn-reaction">
                <i class="far fa-comment"></i>
                <span class="hidden-sm">Comentar</span>
                @if ($post->comments->count())
                    <span class="visible-sm">{{ $post->comments->count() }}</span>
                @endif
            </a>

            @if (Auth::user()->tags->where('post_id', $post->id)->count())
                <a href="{{ route('tag.delete', [Auth::user()->tags()->where('post_id', $post->id)->first()]) }}"
                onclick="event.preventDefault();
                                document.getElementById('tag-delete').submit();" class="btn-reaction">
                    <i class="material-icons -color-green">bookmark</i>
                    <span class="hidden-sm">Guardar</span>
                </a>

                <form id="tag-delete" action="{{ route('tag.delete', [Auth::user()->tags()->where('post_id', $post->id)->first()]) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            @else
                <a href="{{ route('tag') }}"
                onclick="event.preventDefault();
                                document.getElementById('tag-form').submit();" class="like btn-reaction">
                    <i class="material-icons">bookmark_border</i>
                    <span class="hidden-sm">Guardar</span>
                </a>

                <form id="tag-form" action="{{ route('tag') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}" />
                </form>
            @endif
        </div>

        @include('dashboard.forms.comment-post')

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
                    <p class="comment__p">{{ $comment->comment }}</p>


                </div>
            @endforeach
        @endif

    </div>

    <div id="deletePostModal" class="modal form-modal delete-post-modal">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content post-delete">
                <div class="modal-header d-flex">
                    <h4 class="modal-title">Eliminar publicación</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>¿Estas seguro que querés eliminar la publicación?</p>
                    <p>También podés editarla si solo necesitás cambiar algo.</p>
                </div>
                <div class="modal-footer">
                    <form id="delete-post" action="{{ route('post.delete', [$post->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-round -blue -small">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="editPostModal" class="modal form-modal post-modal">
        @include('dashboard.forms.post-edit')
    </div>

