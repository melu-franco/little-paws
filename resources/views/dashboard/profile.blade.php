@php
    \Carbon\Carbon::setLocale('es');
    setlocale(LC_TIME, 'Spanish');
@endphp

@extends('dashboard.app')

@section('content')

<div class="wrapper d-flex wrapper--profile">
     <main class="main">
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
                        <button data-toggle="modal" data-target="#profileModal" class="btn btn-border -white edit-profile"><i class="fas fa-edit"></i> Editar perfil</button>

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
                            <li class="profile__tabs__item"><button class="btn tablinks" onclick="openTab(event, 'About')">Sobre mí</button></li>
                            <li class="profile__tabs__item"><button class="btn tablinks" onclick="openTab(event, 'Followers')">Seguidores <span class="-color-gray">{{$user->followers->count()}}</span></button></li>
                            <li class="profile__tabs__item"><button class="btn tablinks" onclick="openTab(event, 'Following')">Siguiendo <span class="-color-gray">{{$user->following->count()}}</span></button></li>
                        </ul>
                    </div>

                </div>

                <div class="d-flex">
                    <div class="profile__info">
                        <div class="profile__intro">
                            <h2 class="title title--medium">Intro</h2>
                            <p>Agrega datos personales para que las personas sepan más sobre ti.</p>
                            <a href="">Agregar datos personales</a>
                        </div>
                        <div class="section--pets pets">
                            <h2 class="title title--medium">Mascotas</h2>
                            <div class="pets__list d-flex">
                                @foreach ($pets as $pet)
                                    <a href="" class="pets__list__item">
                                        <img src="{{$pet->avatar}}" alt="{{$pet->name}}">
                                        <span class="pets__list__name">{{$pet->name}}</span>
                                    </a>
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
                                @include('dashboard.forms.create-post')
                            @endif
    
                            @if ($posts->count())
                                @foreach ($posts as $post)
                                    @include('dashboard.posts')
                                @endforeach
                            @endif
                        </div>
                        <div id="About" class="tabcontent" style="display:block;">
                            <div class="card">
                                <p>{{ $user->description }}</p>
                            </div>
                        </div>
                        <div id="Followers" class="tabcontent" style="display:block;">
                            <div class="card">
                            </div>
                        </div>
                        <div id="Following" class="tabcontent" style="display:block;">
                            <div class="card">
                            </div>
                        </div>

                    </div>
                </div>


        </section>
    </main>

    @include('dashboard.menu.aside')
</div>

<div id="profileModal" class="modal form-modal">
    @include('dashboard.forms.profile-edit')
</div>

<div id="addPetModal" class="modal form-modal">
    @include('dashboard.forms.pet-create')
</div>

@endsection
