<form method="POST" action="/profile/{{ $user->id }}/update_cover" enctype="multipart/form-data">
    @method('PATCH')
    @csrf

    <div class="form-group">
        <label for="cover" class="btn btn-border edit-cover"><i class="material-icons">photo_camera</i> <span>Cambiar portada</span></label>

        <div class="col-md-6">
            <input id="cover" type="file" name="cover" onChange="this.form.submit()" style="visibility:hidden;display:none;" class="input form-control">
        </div>
    </div>
</form>
