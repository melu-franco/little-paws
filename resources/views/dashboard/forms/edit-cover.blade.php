<form method="POST" action="/profile/{{ $user->id }}/update_cover" enctype="multipart/form-data">
    @method('PATCH')
    @csrf

    <label for="cover" class="btn btn-border btn-edit edit-cover"><i class="material-icons">photo_camera</i> <span>Cambiar portada</span></label>

    <input id="cover" type="file" name="cover" onChange="this.form.submit()" style="visibility:hidden;display:none;" class="input form-control">
</form>
