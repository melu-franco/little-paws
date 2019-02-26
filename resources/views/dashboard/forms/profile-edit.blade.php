<div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content pet-create">

            <div class="modal-header d-flex">
                <h4 class="modal-title"><i class="fas fa-user-edit"></i> Editar perfil</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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

        <form id="updateProfile" method="POST" class="form" action="/profile/{{ $user->id }}">
            @method('PATCH')
            @csrf

            <div class="form-group w-pad">
                <label for="name" class="label"><i class="material-icons">person</i>Nombre</label>
                <input type="text" placeholder="Editar nombre.." class="input {{ $errors->has('content') ? 'is-danger' : '' }}" name="name" id="name" value="{{ $user->name }}">

                @if ($errors->has('name'))
                    @foreach ($errors->all() as $error)
                        <p class="help is-danger">{{ $error }}</p>
                    @endforeach
                @endif
            </div>

            <div class="form-group w-pad">
                <label class="label" for="description"><i class="material-icons">create</i>Descripción</label>
                <textarea class="textarea {{ $errors->has('content') ? 'is-danger' : '' }}" name="description" id="description" placeholder="Editar descripción.." cols="30" rows="10">{{ $user->description }}</textarea>

                @if ($errors->has('description'))
                    @foreach ($errors->all() as $error)
                        <p class="help is-danger">{{ $error }}</p>
                    @endforeach
                @endif
            </div>
        </form>

        <form method="POST" action="/profile/{{ $user->id }}">
            @method('DELETE')
            @csrf
            <button type="submit" class="link -red">Eliminar cuenta</button>
        </form>

        <div class="modal-footer">
            <a href="/profile/{{ $user->id }}" onclick="event.preventDefault(); document.getElementById('updateProfile').submit();" class="btn btn-round -small -blue">
                Guardar
            </a>
        </div>
    </div>
</div>
