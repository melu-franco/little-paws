
@extends('dashboard.app')

@section('content')

    @if ($users->count())
        <div>
            @foreach ($users as $user)
            <div>
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
