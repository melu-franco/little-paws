@extends('layouts.app')

@section('content')

<div id="home" class="home">

    <header class="header header--home flex flex--column flex--align-center flex--justify-center"> 
        <h1 class="header__title -color-white t-center">Little Paws</h1>
        <p class="header__desc -color-white t-center"> No creemos en las distancias, solo en los encuentros.</p>
    </header>

    <section class="section section--desc t-center">
        <p class="section__text -auto t-center"><strong>Little Paws</strong>  no es una red social, es un punto de encuentro. Porque si no nos encontramos, nunca vamos a entender la importancia de estar juntos.</p>
        <a class="-auto btn-round -small -green" href="{{ route('register') }}">Registrarme</a>
    </section>

    <section class="section section--info t-center bg-home--info" >
        <p class="section__text -color-white -auto t-center">Creemos que todos tenemos una misión en este mundo. Nos gusta pensar que la nuestra, es contribuir a que todos seamos un poco mas felices. </p>
    </section>

    <section class="section section--cta -bg-primary flex flex--align-center flex--space-between">
        <p class="section__text -color-white">Creá tu perfil gratis ahora!</p>
        <a href="{{ route('register') }}" class="btn btn-round -small -blue">Unirme</a>
    </section>

</div>

@endsection