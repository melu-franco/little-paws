<div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content pet-create">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar mascota</h4>
            </div>

        <img src="/uploads/avatars/{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" style="border-radius:50%;height:5em;width:5em;object-fit:cover;">

        <form method="POST" class="form" action="/profile/{{ $user->id }}/update_avatar" enctype="multipart/form-data">
            @method('PATCH')
            @csrf

            <div class="form-group">
                <label for="avatar" class="button"><i class="fas fa-pen"></i></label>
                <input id="avatar" type="file" name="avatar" onChange="this.form.submit()" class="hidden">

                @if ($errors->has('avatar'))
                    @foreach ($errors->all() as $error)
                        <p class="help is-danger">{{ $error }}</p>
                    @endforeach
                @endif
            </div>
        </form>

        <form method="POST" action="/profile/{{ $user->id }}/delete_avatar" class="is-pulled-left"  enctype="multipart/form-data">
            @method('DELETE')
            @csrf
            <button type="submit" class="button is-light"><i class="fas fa-trash-alt"></i></button>
        </form>

        <form method="POST" action="/profile/{{ $user->id }}">
            @method('PATCH')
            @csrf

            <div class="form-group">
                <label class="label" for="name"><i class="material-icons">person</i> Editar nombre</label>
                <input type="text" class="form__input {{ $errors->has('content') ? 'is-danger' : '' }}" name="name" id="name" value="{{ $user->name }}">

                @if ($errors->has('name'))
                    @foreach ($errors->all() as $error)
                        <p class="help is-danger">{{ $error }}</p>
                    @endforeach
                @endif
            </div>

            <div class="form-group">
                <label class="label" for="description">Editar descripción</label>
                <textarea class="textarea {{ $errors->has('content') ? 'is-danger' : '' }}" name="description" id="description" cols="30" rows="10">{{ $user->description }}</textarea>

                @if ($errors->has('description'))
                    @foreach ($errors->all() as $error)
                        <p class="help is-danger">{{ $error }}</p>
                    @endforeach
                @endif
            </div>

            <button type="submit" class="button is-primary">Guardar</button>

        </form>

        <div class="is-pulled-left">
            <a href="javascript:void(0)" class="modal-close button is-dark">Cancelar</a>
        </div>

        <form method="POST" action="/profile/{{ $user->id }}">
            @method('DELETE')
            @csrf
            <button type="submit" class="button is-light">Eliminar cuenta</button>
        </form>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
