<div class="section--post-create main-wrapper">
    <div class="border-bottom">
        <h4 class="d-flex post__title w-pad">
            <i class="material-icons">border_color </i>
             Crear publicación
        </h4>
    </div>

    <form method="POST" class="form form--post" action="{{ route('post.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group d-flex w-pad border-bottom">
            <a href="/profile/{{Auth::user()->id}}">
                <img src="/uploads/avatars/{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" style="border-radius:50%;height:3em;object-fit:contain;">
            </a>
            <textarea class="form__textarea no-border {{ $errors->has('content') ? 'is-danger' : '' }}" name="content" placeholder="¿Qué estás pensando?" id="content" cols="30" rows="3"></textarea>
        </div>

        <div class="form-group w-pad">
            <label for="image" class="btn btn-border btn-icon"><i class="material-icons color-green">image</i> Foto</label>
            <input id="image" type="file" name="image" class="hidden">
            <button type="submit" class="btn is-primary">Compartir</button>
        </div>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="help is-danger">{{ $error }}</p>
            @endforeach
        @endif
    </form>

</div>
