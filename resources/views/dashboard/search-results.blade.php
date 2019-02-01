
@extends('dashboard.app')

@section('content')

    @if ($users->count())
        <div>
            @foreach ($users as $user)
            <div class="flex">
                <a href="/profile/{{$user->id}}">
                    <img src="/uploads/avatars/{{ $user->avatar }}" alt="{{ $user->name }}" style="border-radius:50%;height:3em;object-fit:contain;">
                </a>
                <a href="/profile/{{$user->id}}">{{ $user->name }}</a>
            </div>
            @endforeach
        </div>
    @else
        <div>
            <h2>No se encontraron resultados de su búsqueda.</h2>
        </div>
    @endif

@endsection
