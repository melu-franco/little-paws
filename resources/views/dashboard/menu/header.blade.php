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
                    <li class="nav__links">
                       <ul class="d-flex flex-ai-center">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/home') }}">
                                    <i class="material-icons">public</i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users') }}" class="nav-link">
                                    <i class="material-icons">people</i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="material-icons">mail_outline</i>
                                </a>
                            </li>
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
                            <a class="dropdown-item" href="/profile/{{Auth::user()->id}}/edit">
                               <i class="material-icons">edit</i> Editar perfil
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="material-icons">input</i> Cerrar sesión
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
