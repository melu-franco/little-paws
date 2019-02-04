<header class="flex-center position-ref full-height">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel is-fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Little Paws') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="flex" id="">
                <!-- Left Side Of Navbar -->
                <div class="navbar-nav m-auto">
                    @auth
                    <form action="{{ route('search') }}" method="get" role="search">
                            <div class="field flex">
                                <input type="text" class="input" name="search">
                                <button type="submit" class="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    @endauth
                </div>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/profile/{{Auth::user()->id}}">
                                <img src="/uploads/avatars/{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" style="border-radius:50%;height:3em;object-fit:contain;">
                                {{ Auth::user()->name }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/home') }}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users') }}" class="nav-link">
                                <i class="fas fa-user-friends"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link"><i class="fas fa-envelope"></i></a>
                        </li>
                        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-cog"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/profile/{{Auth::user()->id}}/edit">Editar perfil</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

</header>
