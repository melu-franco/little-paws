<div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content pet-create">

            <div class="modal-header d-flex">
                <h4 class="modal-title"><i class="fas fa-user-edit"></i> Editar perfil</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

        <div class="w-pad">
            <img src="/uploads/avatars/{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" style="border-radius:50%;height:5em;width:5em;object-fit:cover;">
        </div>


        <form method="POST" action="/profile/{{ $user->id }}/delete_avatar" class="is-pulled-left"  enctype="multipart/form-data">
            @method('DELETE')
            @csrf
            <button type="submit" class="button is-light"><i class="fas fa-trash-alt"></i></button>
        </form>

        <form id="updateProfile" method="POST" action="/profile/{{ $user->id }}/edit" class="form" >
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

        <div class="modal-footer d-flex">
            <a class="btn btn-round -small -red" href="javascript.void(0);" data-toggle="modal" data-target="#deleteUserModal">
                Eliminar cuenta
            </a>
            <a href="/profile/{{ $user->id }}/edit" onclick="event.preventDefault(); document.getElementById('updateProfile').submit();" class="btn btn-round -small -blue">
                Guardar
            </a>
        </div>
    </div>
</div>
