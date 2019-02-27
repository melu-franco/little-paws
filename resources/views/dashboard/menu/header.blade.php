<header class="header is-fixed-top">
    <nav class="nav">
        <div class="main-container d-flex flex-ai-center">
            <a class="nav__brand" href="{{ url('/') }}">
                {{ config('app.name', 'Little Paws') }}
            </a>

                <form action="{{ route('search') }}" class="form" method="get" role="search">
                    <div class="search-field d-flex">
                        <button type="submit" class="btn btn-search">
                            <i class="material-icons">search</i>
                        </button>
                        <input type="text" class="search" name="search" placeholder="Buscar..">
                    </div>
                </form>

                <ul class="nav__ul ml-auto d-flex">
                    <li class="nav__links hidden-sm">
                       <ul class="d-flex flex-ai-center">
                            <li class="nav-item">
                                <a class="nav-link h-blue" href="{{ url('/home') }}">
                                    <i class="material-icons">public</i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users') }}" class="nav-link h-green">
                                    <i class="material-icons">people</i>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="material-icons">mail_outline</i>
                                </a>
                            </li> --}}
                       </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link avatar" href="/profile/{{Auth::user()->id}}">
                            <img src="/uploads/avatars/{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
                        </a>
                        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="material-icons">arrow_drop_down</i>
                        </a>


                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item d-flex flex-ai-center" href="/profile/{{Auth::user()->id}}">
                               <i class="material-icons">person</i> Ver perfil
                            </a>
                            <a class="dropdown-item d-flex flex-ai-center" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="material-icons">power_settings_new</i> Cerrar sesión
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
        </div>
    </nav>

</header>

<nav class="nav-mobile is-fixed-bottom visible-sm">
    <ul class="nav-mobile__list d-flex">
        <li>
            <a href="/home"> <i class="material-icons">public</i> </a>
        </li>
        <li><a href="{{ route('users') }}"><i class="material-icons">group</i> </a></li>
        <li><a href="javascript:void(0);" data-toggle="modal" data-target="#addPostModal" > <i class="material-icons">add</i> </a></li>
        <li><a href=""></a><i class="material-icons">inbox</i></li>
        <li><a href="/profile/{{Auth::user()->id}}"> <i class="material-icons">person</i> </a></li>
    </ul>
</nav>
