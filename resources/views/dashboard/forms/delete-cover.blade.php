<form method="POST" action="/profile/{{ $user->id }}/delete_cover" class="is-pulled-left" enctype="multipart/form-data">
    @method('DELETE')
    @csrf
    <div class="field">
        <div class="control">
            <button type="submit" class="btn delete-cover"><i class="material-icons">cancel</i></button>
        </div>
    </div>
</form>
