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
            <a href="/profile/{{Auth::user()->id}}" class="avatar">
                <img src="/uploads/avatars/{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
            </a>
            <textarea class="no-border {{ $errors->has('content') ? 'is-danger' : '' }}" name="content" placeholder="¿Qué estás pensando?" id="content" cols="30" rows="2"></textarea>
            @if ($errors->has('content') || $errors->has('image'))
                @foreach ($errors->all() as $error)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $error }}</strong>
                </span>
                @endforeach
            @endif
        </div>

        <div class="form-group add-image">

            <div class="setting image_picker -no-pad">
                <div class="settings_wrap post-foto">
                    <div class="d-flex">
                        <label class="drop_target image-hidden d-flex">
                            <div class="image_preview"></div>
                            <input class="hidden" id="inputFile" name="image" type="file"/>
                        </label>

                        <a class="disabled remove" data-action="remove_current_image"><i class="material-icons">cancel</i></a>
                    </div>

                    <div class="d-flex">
                        <label for="inputFile" class="btn btn-border btn-icon"><i class="material-icons">image</i> Foto</label>
                        <button type="submit" class="btn btn-round -blue -small ml-auto">Compartir</button>
                    </div>
                </div>
            </div>

        </div>

    </form>

</div>
