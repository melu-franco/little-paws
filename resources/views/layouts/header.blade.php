<header class="flex-center position-ref full-height">
    <div class="top-right links">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/faq') }}">Faq</a>
        @auth
            <a href="{{ url('/home') }}">Inicio</a>
        @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        @endauth
    </div>
</header>
