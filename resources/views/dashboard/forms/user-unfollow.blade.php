<form method="post" action="{{ route('user.unfollow', $user->id) }}" >
    @csrf
    <div class="field">
        <div class="control">
            <button type="submit" class="button is-light">Dejar de seguir</button>
        </div>
    </div>
</form>
