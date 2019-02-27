<form method="post" class="form form--comment" action="{{ route('comment.add') }}">
    @csrf
    <div class="form-group d-flex w-pad border-top flex-ai-center">
        <a href="/profile/{{Auth::user()->id}}" class="avatar">
            <img src="/uploads/avatars/{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" style="">
        </a>
        <textarea class="no-border" name="comment" placeholder="Escribí un comentario.." id="comment" cols="30"></textarea>
        <input type="hidden" name="post_id" value="{{ $post->id }}" />

        <button type="submit" class="btn"><i class="material-icons -color-blue">send</i></button>
        @if ($errors->has('comment'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('comment') }}</strong>
            </span>
        @endif
    </div>
</form>
