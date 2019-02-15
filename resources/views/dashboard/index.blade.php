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

            @include('dashboard.forms.create-post')


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

            @endif
        </section>

    </main>

    <div class="aside">
        <div class="tab">
            <button class="btn tablinks active" onclick="openTab(event, 'Latest')">Recientes</button>
            <button class="btn tablinks" onclick="openTab(event, 'Following')">Siguiendo</button>
        </div>
    </div>
</div>

<script type="text/javascript">
    var token = '{{ Session::token() }}';
    var urlLike = '{{ route('like') }}';
</script>
<script src="{{ asset('js/like.js') }}"></script>

@endsection
