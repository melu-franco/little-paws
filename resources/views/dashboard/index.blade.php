@php
    \Carbon\Carbon::setLocale('es');
    setlocale(LC_TIME, 'Spanish');
@endphp

@extends('dashboard.app')

@section('content')

@include('dashboard.menu.sidebar')

<div class="wrapper d-flex">
     <main class="main">

        <section class="section section--main">

            <div class="hidden-sm">
                @include('dashboard.forms.create-post')
            </div>

            @if ($posts->count())

                <div id="Latest" class="section--posts tabcontent" style="display:block;">

                    @foreach ($posts as $post)
                        @include('dashboard.posts')
                    @endforeach
                </div><!-- Latest -->

                <div id="Following" class="section--posts tabcontent">

                    @foreach ($posts_following as $post)
                        @include('dashboard.posts')
                    @endforeach
                </div> <!-- Siguiendo -->

                <div id="Tagged" class="section--posts tabcontent">
                    @foreach ($posts_tagged as $post)
                        @include('dashboard.posts')
                    @endforeach
                </div> <!-- Guardados -->

            @endif
        </section>

    </main>

    <div class="aside">
        <div class="tab">
            <button class="btn btn-border btn-icon tablinks active" onclick="openTab(event, 'Latest')" style="margin-bottom:1em;margin-right:1em;">Recientes</button>
            <button class="btn btn-border btn-icon tablinks" onclick="openTab(event, 'Following')" style="margin-bottom:1em;margin-right:1em;">Siguiendo</button>
            <button class="btn btn-border btn-icon tablinks hidden-sm" onclick="openTab(event, 'Tagged')" style="margin-bottom:1em;margin-right:1em;">Guardados</button>
        </div>
    </div>
</div>

<div id="addPostModal" class="modal form-modal post-modal">
    @include('dashboard.forms.create-post-modal')
</div>

@endsection
