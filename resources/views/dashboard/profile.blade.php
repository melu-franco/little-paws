@php
    \Carbon\Carbon::setLocale('es');
    setlocale(LC_TIME, 'Spanish');
@endphp

@extends('dashboard.app')

@section('content')

@include('dashboard.menu.sidebar')

<div class="wrapper d-flex">

    <section class="section section--main profile">

            <div class="profile__cover">

                <div class="profile__cover__bg" style="{{ $user->cover != '' ? "background-image:url('/uploads/covers/$user->cover');" : 'background-color:#aaa;'}}">

                @if(Auth::user()->id == $user->id)

                    <div class="d-flex flex-jc-between">
                        @include('dashboard.forms.edit-cover')

                        @if($user->cover != '')
                            @include('dashboard.forms.delete-cover')
                        @endif
                    </div>

                    @if ($errors->has('cover'))
                        @foreach ($errors->all() as $error)
                            <p class="help is-danger">{{ $error }}</p>
                        @endforeach
                    @endif
                    <button data-toggle="modal" data-target="#profileModal" class="btn btn-border btn-icon -white edit-profile"><i class="fas fa-edit"></i> Editar perfil</button>

                @else

                    @if(Auth::user()->is_following($user->id))
                        @include('dashboard.forms.user-unfollow')
                    @else
                        @include('dashboard.forms.user-follow')
                    @endif

                @endif

                <div class="profile__avatar d-flex">

                    <div class="profile__avatar__edit">
                        <img src="/uploads/avatars/{{ $user->avatar }}" alt="{{ $user->name }}">
                        <form method="POST" class="form" action="/profile/{{ $user->id }}/update_avatar" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf

                            <label for="avatar" class="button"><i class="material-icons">photo_cameras</i>Editar</label>
                            <input id="avatar" type="file" name="avatar" onChange="this.form.submit()" class="hidden">

                        </form>
                        @if ($errors->has('avatar'))
                            @foreach ($errors->all() as $error)
                                <p class="help is-danger">{{ $error }}</p>
                            @endforeach
                        @endif
                    </div>


                    <h1 class="profile__name">{{ $user->name }}</h1>
                </div>

            </div>

                <div class="profile__tabs">
                    <ul class="d-flex">
                        <li class="profile__tabs__item"><button class="btn tablinks active" onclick="openTab(event, 'Posts')">Posts</button></li>
                        <li class="profile__tabs__item"><button class="btn tablinks" onclick="openTab(event, 'Pets')">Mascotas</button></li>
                        <li class="profile__tabs__item"><button class="btn tablinks" onclick="openTab(event, 'Followers')">Seguidores <span class="-color-gray">{{$user->followers->count()}}</span></button></li>
                        <li class="profile__tabs__item"><button class="btn tablinks" onclick="openTab(event, 'Following')">Siguiendo <span class="-color-gray">{{$user->following->count()}}</span></button></li>
                    </ul>
                </div>

            </div>

            <div class="d-flex flex-wrap">
                <div class="profile__info">
                    <div class="profile__intro">
                        <h2 class="title title--medium">Intro</h2>
                        <p>Agrega datos personales para que las personas sepan más sobre ti.</p>
                        <a href="">Agregar datos personales</a>
                    </div>
                    <div class="section--pets pets">
                        <h2 class="title title--medium">Mascotas</h2>
                        <div class="pets__list d-flex flex-wrap">
                            @foreach ($pets as $pet)
                                    <button data-toggle="modal"  data-target="#PetEditModal" class="pets__list__item">
                                    <img src="{{$pet->avatar}}" alt="{{$pet->name}}">
                                    <span class="pets__list__name">{{$pet->name}}</span>
                                </button>
                            @endforeach
                            <button data-toggle="modal" data-target="#addPetModal" class="btn pets__list__item">
                                <div class="add">
                                    <i class="material-icons">add</i>
                                </div>
                                <span class="pets__list__name">Agregar</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="profile__content">
                    <div id="Posts" class="tabcontent" style="display:block;">
                        @if(Auth::user()->id == $user->id)
                            <div class="hidden-sm">@include('dashboard.forms.create-post')</div>
                        @endif

                        @if ($posts->count())
                            @foreach ($posts as $post)
                                @include('dashboard.posts')
                            @endforeach
                        @else
                            <div class="card">
                                <p class="t-center">
                                    @if(Auth::user()->id == $user->id)
                                    Aún no tenés publicaciones.
                                    @else
                                    Aún no hay información cargada de este usuario.
                                    @endif
                                </p>
                            </div>
                        @endif
                    </div>
                    <div id="Pets" class="tabcontent">
                        <div class="card">
                            <h2 class="title title--medium">Mascotas</h2>
                            @if($user->pets->count())
                                @foreach ($pets as $pet)
                                <div class="pets__list__item">
                                    <img src="{{$pet->avatar}}" alt="{{$pet->name}}">
                                    <span class="pets__list__name">{{$pet->name}}</span>
                                </div>
                                @endforeach
                            @else
                                <p>
                                    @if(Auth::user()->id == $user->id)
                                    Aún no agregaste ninguna mascota.
                                    <button data-toggle="modal" data-target="#addPetModal" class="btn">
                                        Agregar mascota
                                    </button>
                                    @else
                                    Aún no hay mascotas cargadas.
                                    @endif
                                </p>
                            @endif
                        </div>
                    </div>
                    <div id="Followers" class="tabcontent">
                        <div class="card">
                            <h2 class="title title--medium">Seguidores</h2>
                        </div>
                    </div>
                    <div id="Following" class="tabcontent">
                        <div class="card">
                            <h2 class="title title--medium">Siguiendo a</h2>
                        </div>
                    </div>

                </div>
            </div>


    </section>

    @include('dashboard.menu.aside')
</div>

<div id="profileModal" class="modal form-modal">
    @include('dashboard.forms.profile-edit')
</div>

<div id="addPetModal" class="modal form-modal">
    @include('dashboard.forms.pet-create')
</div>

@if($user->pets->count())
<div id="PetEditModal" class="modal form-modal">
    @include('dashboard.forms.pet-edit')
</div>
@endif

<div id="addPostModal" class="modal form-modal post-modal">
    @include('dashboard.forms.create-post-modal')
</div>

@endsection
