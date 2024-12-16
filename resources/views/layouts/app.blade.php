<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    
    @vite('resources/js/app.js')
    
    
    
</head>
<body>

    <div class="header">
        <div class="container-top">

            <div class="hamburger" id="hamburger">
                &#9776; 
            </div>

            <div class="logo-png">
                <a href="{{ route('home') }}">
                    <img src="https://blog.euroimportpneumatici.com/wp-content/uploads/2016/05/omino-michelin.jpg"  alt="">
                </a>         
            </div>
            
        </div>
        
        <div class="container-button">

            <div class="user-utente">
                @auth
                    <a href="{{route('profile.update')}}">
                        <img src="{{ asset(Auth::user()->img_url) }}" > 
                    </a>
                @endauth
            </div>

            <form action="{{ route('logout') }}" method="POST" class="">
                @csrf
                <button type="submit">Logout</button>
            </form>
            
        </div>
        
    </div>


    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-top">
                <ul class="list-group">
                  
                    <li class="list-group-item"><a href="{{ route('home') }}" class="d-block">Home</a></li>
                    <li class="list-group-item"><a href="{{ route('clienti.index') }}" class="d-block">Clienti</a></li>
                    <li class="list-group-item"><a href="{{ route('servizi.index') }}"class="d-block">Servizi</a></li>
                    <li class="list-group-item"><a href="{{ route('tecnici.index') }}"class="d-block">Tecnici</a></li>
                    <li class="list-group-item"><a href="{{ route('jobs.index') }}"class="d-block" >lavori</a></li>
                </ul>
            </div>
        </div>

        

        <!-- Contenuto principale -->
        <div class="main-content">
            
                @yield('content')  <!-- Qui sarà caricato il contenuto dinamico -->
            
            
        </div>
    </div>
    
</body>
</html>
