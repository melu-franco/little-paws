<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content post-edit">

        <div class="modal-header d-flex">
            <h4 class="modal-title">Editar post</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
            <form method="POST" action="/posts/{{ $post->id }}">
                @method('PATCH')
                @csrf

                <div class="field">
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

                <div class="field is-pulled-left">
                    <div class="control">
                        <button type="submit" class="button is-primary">Guardar</button>
                    </div>
                </div>
            </form>

            @if($post->image != '')
                <img src="/uploads/posts/thumbnail/{{ $post->image }}" alt="Post image" style="width:90px;">

                <form method="POST" action="/posts/{{ $post->id }}/update_image" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf

                    <div class="field">
                        <label for="image" class="button"><i class="fas fa-pen"></i></label>

                        <div class="col-md-6">
                            <input id="image" type="file" name="image" onChange="this.form.submit()" style="visibility:hidden;display:none;" class="input form-control">
                        </div>
                    </div>
                </form>

                <form method="POST" action="/posts/{{ $post->id }}/delete_image" class="is-pulled-left" enctype="multipart/form-data">
                    @method('DELETE')
                    @csrf
                    <div class="field">
                        <div class="control">
                            <button type="submit" class="button is-light"><i class="fas fa-times-circle"></i></button>
                        </div>
                    </div>
                </form>

                @if ($errors->has('image'))
                    @foreach ($errors->all() as $error)
                        <p class="help is-danger">{{ $error }}</p>
                    @endforeach
                @endif

            @else

                <form method="POST" action="/posts/{{ $post->id }}/update_image" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf

                    <div class="field">
                        <label for="image" class="button"><i class="fas fa-image"></i> Foto</label>

                        <div class="col-md-6">
                            <input id="image" type="file" name="image" onChange="this.form.submit()" class="input form-control">
                        </div>
                    </div>
                </form>


            @endif



            <form method="POST" action="/posts/{{ $post->id }}">
                @method('DELETE')
                @csrf

                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-light">Eliminar Post</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
    </div>
</div>
