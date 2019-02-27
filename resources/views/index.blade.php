@extends('layouts.app')

@section('content')

<div id="home" class="home">

    <header class="header header--home flex flex--column flex--align-center flex--justify-center"> 
        <h1 class="header__title -color-white t-center">Little Paws</h1>
        <p class="header__desc -color-white t-center"> No creemos en las distancias, solo en los encuentros.</p>
    </header>

    <section class="section section--desc t-center">
        <p class="section__text -auto"><strong>Little Paws</strong>  no es una red social, es un punto de encuentro. Porque si no nos encontramos, nunca vamos a entender la importancia de estar juntos.</p>
        <a class="-auto btn btn--green max-width" href="{{ route('register') }}">Registrarme</a>
    </section>

    <section class="section section--info t-center bg-home--info" >
        <p class="section__text -color-white -auto">Creemos que todos tenemos una misión en este mundo. Nos gusta pensar que la nuestra, es contribuir a que todos seamos un poco mas felices. </p>
    </section>

     <section class="section section--faqs container">
        <div class="dropdown">
            <input type="checkbox" id="question-1">
            <label class="dropdown__question -color-secondary" for="question-1">¿Cómo me armo un usuario?</label>
            <div class="dropdown__answer answer">
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.  Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
            </div><!-- text -->
        </div><!-- dropdown -->
        <div class="dropdown">
            <input type="checkbox" id="question-2">
            <label class="dropdown__question -color-secondary" for="question-2">¿Cómo sumar mas de una mascota?</label>
            <div class="dropdown__answer answer">
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.  Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
            </div><!-- text -->
        </div><!-- dropdown -->
        <div class="dropdown">
            <input type="checkbox" id="question-3">
            <label class="dropdown__question -color-secondary" for="question-3">¿Para qué me sirve la plataforma?</label>
            <div class="dropdown__answer answer">
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.  Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
            </div><!-- text -->
        </div><!-- dropdown -->
        <div class="dropdown">
            <input type="checkbox" id="question-4">
            <label class="dropdown__question -color-secondary" for="question-4">¿Cómo comparto una publicación?</label>
            <div class="dropdown__answer answer">
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.  Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
            </div><!-- text -->
        </div><!-- dropdown -->
        <div class="dropdown">
            <input type="checkbox" id="question-5">
            <label class="dropdown__question -color-secondary" for="question-5">¿Dónde veo los animales perdidos?</label>
            <div class="dropdown__answer answer">
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.  Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
            </div><!-- text -->
        </div><!-- dropdown -->
        <div class="dropdown">
            <input type="checkbox" id="question-6">
            <label class="dropdown__question -color-secondary" for="question-6">¿Puedo cargar todo tipo de mascotas?</label>
            <div class="dropdown__answer answer">
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.  Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
            </div><!-- text -->
        </div><!-- dropdown -->
        <div class="dropdown">
            <input type="checkbox" id="question-7">
            <label class="dropdown__question -color-secondary" for="question-7">¿Cómo me puedo contactar con otra mascota?</label>
            <div class="dropdown__answer answer">
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.  Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
            </div><!-- text -->
        </div><!-- dropdown -->
        <div class="dropdown">
            <input type="checkbox" id="question-8">
            <label class="dropdown__question -color-secondary" for="question-8">¿Cómo busco nuevas mascotas?</label>
            <div class="dropdown__answer answer">
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.  Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
            </div><!-- text -->
        </div><!-- dropdown -->

    </section>

    <section class="section section--cta -bg-primary flex flex--align-center flex--space-between">
        <p class="section__text -color-white">Creá tu perfil gratis ahora!</p>
        <a href="{{ route('register') }}" class="btn btn--white">Unirme</a>
    </section>

</div>

@endsection