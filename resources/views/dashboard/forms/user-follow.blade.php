<form method="post" action="{{ route('user.follow', $user->id) }}" >
    @csrf
    <div class="field">
        <div class="control">
            <button type="submit" class="button is-light">Seguir</button>
        </div>
    </div>
</form>
