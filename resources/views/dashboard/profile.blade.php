@php
    \Carbon\Carbon::setLocale('es');
    setlocale(LC_TIME, 'Spanish');
@endphp

@extends('dashboard.app')

@section('content')
<section class="section section--main profile">

        <div class="profile__cover">

            <div class="profile__cover__bg" style="{{ $user->cover != '' ? "background-image:url('/uploads/covers/$user->cover');" : 'background-color:#aaa;'}}">

            @if(Auth::user()->id == $user->id)
                <form method="POST" action="/profile/{{ $user->id }}/update_cover" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf

                    <div class="form-group">
                        <label for="cover" class="btn btn-border"><i class="material-icons">photo</i> Editar portada</label>

                        <div class="col-md-6">
                            <input id="cover" type="file" name="cover" onChange="this.form.submit()" style="visibility:hidden;display:none;" class="input form-control">
                        </div>
                    </div>
                </form>

                @if($user->cover != '')
                    <form method="POST" action="/profile/{{ $user->id }}/delete_cover" class="is-pulled-left" enctype="multipart/form-data">
                        @method('DELETE')
                        @csrf
                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-light"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </form>
                @endif

                @if ($errors->has('cover'))
                    @foreach ($errors->all() as $error)
                        <p class="help is-danger">{{ $error }}</p>
                    @endforeach
                @endif

            @else

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

            @endif

            <div class="profile__avatar d-flex">
                <img src="/uploads/avatars/{{ $user->avatar }}" alt="{{ $user->name }}">
                <h1 class="profile__name">{{ $user->name }}</h1>
            </div>

        </div>

            <div class="profile__tabs">
                <ul class="d-flex">
                    <li><a href="">Posts</a></li>
                    <li><a href="">Sobre mí</a></li>
                    <li><a href="">Seguidores <span>{{$user->followers->count()}}</span></a></li>
                    <li><a href="">Siguiendo <span>{{$user->following->count()}}</span></a></li>
                </ul>
            </div>

        </div>

        <p>{{ $user->description }}</p>

        <div class="section--pets pets">
                <h2 class="title title--medium">Pet List</h2>
                <div class="pets__list d-flex">
                    <a href="" class="pets__list__item">
                        <div class="add">
                            <i class="material-icons">add</i>
                        </div>
                        <span class="pets__list__name">Agregar</span>
                    </a>
                    @foreach ($pets as $pet)
                        <a href="" class="pets__list__item">
                            <img src="{{$pet->avatar}}" alt="{{$pet->name}}">
                            <span class="pets__list__name">{{$pet->name}}</span>
                        </a>
                    @endforeach
                </div>
            </div>

        @if(Auth::user()->id == $user->id)
            <a href="/profile/{{$user->id}}/edit">Editar perfil</a>

            @include('dashboard.forms.create-post')

        @endif

        @if ($posts->count())
            @foreach ($posts as $post)
                @include('dashboard.posts')
            @endforeach
        @endif
</section>

@endsection
