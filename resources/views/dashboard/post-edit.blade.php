@extends('dashboard.app')

@section('content')
    <h1>Editar post</h1>

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

    <div class="is-clearfix"></div>

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

    <div class="is-pulled-left">
        <a href="{{ URL::previous() }}" class="button is-dark">Cancelar</a>
    </div>

    <div class="is-clearfix"></div>

@endsection
