<div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content pet-create">

            <div class="modal-header d-flex">
                <h4 class="modal-title"><i class="fas fa-user-edit"></i> Editar descripción</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

        <form id="updateDescription" method="POST" class="form" action="/profile/{{ $user->id }}">
            @method('PATCH')
            @csrf

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
            <a href="/profile/{{ $user->id }}" onclick="event.preventDefault(); document.getElementById('updateDescription').submit();" class="btn btn-round -small -blue">
                Guardar
            </a>
        </div>
    </div>
</div>
