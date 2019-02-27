<div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content pet-create">

            <div class="modal-header d-flex">
                <h4 class="modal-title"> <i class="material-icons">edit</i> Editar mascota</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

        <img src="{{ $pet->avatar }}" alt="{{ $pet->name }}" style="border-radius:50%;height:5em;width:5em;object-fit:cover;">

        <form method="POST" action="/pet/{{ $pet->id }}/delete_avatar" class="form"  enctype="multipart/form-data">
            @method('DELETE')
            @csrf
            <button type="submit" class="button is-light"><i class="fas fa-trash-alt"></i></button>
        </form>

        <form method="POST" id="petEdit" class="form" action="/pet/{{ $pet->id }}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf

            <div class="form-group avatar w-pad">
                <div class="setting image_picker">
                    <div class="settings_wrap d-flex">
                        <label class="drop_target">
                            <div class="image_preview"></div>
                            <input id="inputFile" name="avatar" type="file"/>
                        </label>
                        <div class="settings_actions vertical">
                            <label for="inputFile" class="choose-file"><i class="fa fa-picture-o"></i> Subir archivo</label>
                            <a class="disabled" data-action="remove_current_image"><i class="fa fa-ban"></i> Eliminar archivo</a>
                        </div>
                    </div>
                </div>

                @if ($errors->has('avatar'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('avatar') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group w-pad">
                <label class="label" for="name"><i class="material-icons">person</i> Editar nombre</label>
                <input type="text" class="input {{ $errors->has('content') ? 'is-danger' : '' }}" name="name" id="name" value="{{ $pet->name }}">

                @if ($errors->has('name'))
                    @foreach ($errors->all() as $error)
                        <p class="help is-danger">{{ $error }}</p>
                    @endforeach
                @endif
            </div>

            <div class="form-group w-pad">
                <label class="label" for="description"><i class="material-icons">create</i>Descripción</label>
                <textarea class="textarea {{ $errors->has('content') ? 'is-danger' : '' }}" placeholder="Editar descripción.." name="description" id="description" cols="30" rows="10">{{ $pet->description }}</textarea>

                @if ($errors->has('description'))
                    @foreach ($errors->all() as $error)
                        <p class="help is-danger">{{ $error }}</p>
                    @endforeach
                @endif
            </div>

        </form>

        <div class="modal-footer">
            <form method="POST" action="/pet/{{ $pet->id }}">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-round -small -red">Eliminar perfil</button>
            </form>
            <a href="/pet/{{ $pet->id }}" onclick="event.preventDefault(); document.getElementById('petEdits').submit();" class="btn btn-round -small -blue">
                Guardar
            </a>
        </div>
    </div>
</div>
