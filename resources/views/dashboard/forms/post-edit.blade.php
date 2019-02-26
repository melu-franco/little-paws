<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content post-edit">

        <div class="modal-header d-flex">
            <h4 class="modal-title">
                <i class="material-icons">edit</i>
                Editar post
            </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <form method="POST" id="updatePost" class="form" action="/posts/{{ $post->id }}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf

            <div class="form-group w-pad">
                <label class="label" for="content">Editar comentario</label>

                <div class="control">
                    <textarea class="textarea {{ $errors->has('content') ? 'is-danger' : '' }}" name="content" id="content" cols="30" rows="10">{{ $post->content }}</textarea>
                </div>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p class="help is-danger">{{ $error }}</p>
                    @endforeach
                @endif
            </div>

            <div class="form-group add-image w-pad">

                <div class="setting image_picker -no-pad">
                    <div class="settings_wrap post-foto">
                        <div class="d-flex absolute">
                            <label class="drop_target drop_target_modal image-hidden d-flex">
                                <div class="image_preview image_preview_modal"></div>
                                <input class="hidden" id="inputFileModal" name="image" type="file"/>
                            </label>

                            <a class="disabled remove remover_modal" data-action="remove_current_image"><i class="material-icons">cancel</i></a>
                        </div>

                        <label for="inputFileModal" class="label-image btn btn-border btn-icon{{ $post->image != '' ? ' margin-top' : '' }}"><i class="material-icons">image</i> Foto</label>
                    </div>
                </div>

            </div>

        </form>

        @if($post->image != '')
            <div class="d-flex thumbnail-preview">
                <img src="/uploads/posts/thumbnail/{{ $post->image }}" alt="Post image" class="post-thumbnail">

                <form method="POST" action="/posts/{{ $post->id }}/delete_image" enctype="multipart/form-data">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn remove-image"><i class="material-icons">cancel</i></button>
                </form>
            </div>
        @endif

        <div class="modal-footer d-flex">
            <form method="POST" action="/posts/{{ $post->id }}">
                @method('DELETE')
                @csrf

                <button type="submit" class="btn btn-round -small -red">Eliminar Post</button>
            </form>
            <a href="/posts/{{ $post->id }}" onclick="event.preventDefault(); document.getElementById('updatePost').submit();" class="btn btn-round -small -blue">
                Guardar
            </a>
        </div>

    </div>
</div>
