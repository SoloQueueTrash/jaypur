<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('welcome') }}">Jaypur Pedras</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('products') }}">Produtos</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">Sobre Nós</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contacts') }}">Contactos</a></li>

                @if(auth()->user() && auth()->user()->isadmin == 1)
                <li class="nav-item"><a class="nav-link" href="{{ route('admin') }}">Admin</a></li>
                @endif

            </ul>
        </div>
        <div class="ml-auto">
            <ul class="navbar-nav">
                @if (Route::has('login'))
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Sair</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li><a class="nav-link" href="{{ route('login') }}">Entrar</a></li>
                @if (Route::has('register'))
                <li><a class="nav-link" href="{{ route('register') }}">Registo</a></li>
                @endif
                @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>