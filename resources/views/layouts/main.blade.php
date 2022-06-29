<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getlocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>@yield('title')</title>

        <!-- Fonte das paginas -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Anek+Malayalam" rel="stylesheet">

        <!-- CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

        <!-- CSS Nativo -->
        <link rel="stylesheet" href="/css/styles.css">
        <script src="/js/scripts.js"></script>
    </head>
    
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse" id="navbar">
                    <a href="/" class="navbar-brand">
                       <img src="" alt="Logo EsportsNews">   
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link">Noticias</a>
                        </li>

                        <li class="nav-item">
                            <a href="/reports/main/CSGO" class="nav-link">CSGO</a>
                        </li>
                        <li class="nav-item">
                            <a href="/reports/main/Valorant" class="nav-link">Valorant</a>
                        </li>
                        <li class="nav-item">
                            <a href="/reports/main/R6" class="nav-link">Rainbow Six</a>
                        </li>

                        @auth
                        <li class="nav-item">
                            <a href="/reports/create" class="nav-link">Nova Noticia</a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link">Minhas Noticias</a>
                        </li><li class="nav-item">
                            <form action="/logout" method="POST">
                                @csrf
                                <a href="/logout" 
                                   class="nav-link" 
                                   onclick="event.preventDefault();
                                   this.closest('form').submit();"
                                        >
                                    Sair
                                </a>
                            </form>
                        </li>
                        @endauth
                        @guest
                        <li class="nav-item">
                            <a href="/login" class="nav-link">Entrar</a>
                        </li><li class="nav-item">
                            <a href="/register" class="nav-link">Cadastrar</a>
                        </li>
                        @endguest
                        <span>
                            <form action="/" method="GET">
                                <input type="text" id="search" name="search" placeholder="Buscar" class="form-control">
                            </form>
                        </span>
                    </ul>
                </div>

            </nav>
        </header>
        <main>
            <div class="container-fluid">
                <div class="row">
                @if(session('msg'))
                    <p class="msg">{{ session('msg') }}</p>
                @endif
                @yield('content')
                </div>
            </div>
        </main>
        <footer>
            <p>EsportsNews &copy; 2022</p>
        </footer>
        <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    </body>
</html>