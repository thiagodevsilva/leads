<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonte do Google-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">        

        <!-- CSS Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <!-- CSS Local-->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">        

        <!-- JQUERY E JQUERY MASK -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-light">
                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav" style="margin-right: 50px;">
                        @if (isset($_SESSION['auth']))
                            @if ($_SESSION['auth'] == 1)
                                <li class="nav-item">
                                    <a href="#" class="nav-link">TBS</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Níveis</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Listas</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Novo Tema</a>
                                </li> 
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Sair</a>
                                </li>
                            @endif
                        @else
                            @if (request()->route()->getName() != 'login')
                                <li class="nav-item">
                                    <a href="/login" class="nav-link">Área restrita</a>
                                </li>
                            @else 
                            <li class="nav-item">
                                <a href="/" class="nav-link">Home</a>
                            </li>
                            @endif
                        @endif                        
                    </ul>
                </div>
            </nav>
        </header>    

        <main>
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    {{ session()->flash('success') }}
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                    @endforeach
                </div>
                @endif

                <div class="">                    
                    @yield('content')
                </div>
            </div>
        </main>

        <footer>
            <p> Thiago Silva &copy; 2023</p>
        </footer>

    </body>
</html>