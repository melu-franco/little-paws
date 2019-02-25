<form method="post" action="{{ route('user.follow', $user->id) }}" >
    @csrf
    <div class="field">
        <div class="control">
            <button type="submit" class="btn btn-border btn-icon -white edit-profile"><i class="fas fa-user-plus"></i><span>Seguir</span></button>
        </div>
    </div>
</form>
