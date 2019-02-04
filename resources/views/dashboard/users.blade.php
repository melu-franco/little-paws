
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
            </div>
            @endforeach
        </div>
    @else
        <div>
            <h2>No se encontraron usuarios.</h2>
        </div>
    @endif

@endsection
