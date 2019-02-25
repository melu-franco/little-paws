<form method="post" action="{{ route('user.unfollow', $user->id) }}" >
    @csrf
    <div class="field">
        <div class="control">
            <button type="submit" class="btn btn-border btn-icon -white edit-profile"><i class="fas fa-user-minus"></i><span>Dejar de seguir</span></button>
        </div>
    </div>
</form>
