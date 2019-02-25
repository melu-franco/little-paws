
@extends('dashboard.app')

@section('content')
<div class="wrapper d-flex wrapper--profile">
    <main class="main">
        <section class="section section--main users card">
        @if ($users->count())
            <div class="d-flex flex-wrap">
                @foreach ($users as $user)
                <div class="users__user d-flex">
                    <a href="/profile/{{$user->id}}">
                        <img class="users__user__avatar" src="/uploads/avatars/{{ $user->avatar }}" alt="{{ $user->name }}">
                        <p class="users__user__name">{{ $user->name }}</p>
                    </a>

                    <div class="d-flex">
                        @if(Auth::user()->is_following($user->id))
                            @include('dashboard.forms.user-unfollow')
                        @else
                            @include('dashboard.forms.user-follow')
                        @endif

                        <a href="/profile/{{$user->id}}" class="btn btn-border btn-icon"><i class="fas fa-eye"></i></a>
                    </div>

                </div>
                @endforeach
            </div>
        @else
            <div>
                <h2>No se encontraron usuarios.</h2>
            </div>
        @endif
    </section>
</main>

@include('dashboard.menu.aside')
</div>

@endsection
