
@extends('dashboard.app')

@section('content')

    @if ($users->count())
        <div class="flex" style="flex-wrap:wrap;">
            @foreach ($users as $user)
            <div class="-col flex" style="width:25%;flex-direction:column;align-items:center;margin-bottom:1em;">
                <a href="/profile/{{$user->id}}">
                    <img src="/uploads/avatars/{{ $user->avatar }}" alt="{{ $user->name }}" style="border-radius:50%;height:3em;object-fit:contain;">
                </a>
                <a href="/profile/{{$user->id}}">{{ $user->name }}</a>

                @if(Auth::user()->is_following($user->id))
                    <form method="post" action="{{ route('user.unfollow', $user->id) }}" >
                        @csrf
                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-light">Unfollow</button>
                            </div>
                        </div>
                    </form>
                @else
                    <form method="post" action="{{ route('user.follow', $user->id) }}" >
                        @csrf
                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-light">Follow</button>
                            </div>
                        </div>
                    </form>
                @endif

            </div>
            @endforeach
        </div>
    @else
        <div>
            <h2>No se encontraron usuarios.</h2>
        </div>
    @endif

@endsection
