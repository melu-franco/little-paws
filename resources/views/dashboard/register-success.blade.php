@extends('dashboard.app')

@section('content')
    <h1>Usuario registrado con éxito</h1>

    <a href="{{route('pet.create')}}">Agregar perfil de mascota</a>

    <a href="/home">Ir a la home</a>

@endsection
