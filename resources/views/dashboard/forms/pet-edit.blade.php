<div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content pet-create">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Editar mascota</h4>
            </div>

        <img src="{{ $pet->avatar }}" alt="{{ $pet->name }}" style="border-radius:50%;height:5em;width:5em;object-fit:cover;">

        <form method="POST" class="form" action="/pet/{{ $pet->id }}/update_avatar" enctype="multipart/form-data">
            @method('PATCH')
            @csrf

            <div class="form-group w-pad">
                <label for="avatar" class="button"><i class="fas fa-pen"></i></label>
                <input id="avatar" type="file" name="avatar" onChange="this.form.submit()" class="hidden">

                @if ($errors->has('avatar'))
                    @foreach ($errors->all() as $error)
                        <p class="help is-danger">{{ $error }}</p>
                    @endforeach
                @endif
            </div>
        </form>

        <form method="POST" action="/pet/{{ $pet->id }}/delete_avatar" class="form"  enctype="multipart/form-data">
            @method('DELETE')
            @csrf
            <button type="submit" class="button is-light"><i class="fas fa-trash-alt"></i></button>
        </form>

        <form method="POST" class="form" action="/pet/{{ $pet->id }}">
            @method('PATCH')
            @csrf

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

            <button type="submit" class="btn btn-round -large -blue">Guardar</button>

        </form>

        <form method="POST" action="/pet/{{ $pet->id }}">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-round -large -red">Eliminar perfil</button>
        </form>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
    </div>
</div>
