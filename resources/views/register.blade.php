<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    
    <link rel="stylesheet" href="css/style.css">
    @vite('resources/js/app.js')
    
</head>

<form class="form-register-login" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
    @csrf

    <!-- Titolo -->
    <h2 class="text-center mb-4">Registrati</h2>

    <!-- Nome -->
    <div class="form-group">
        <label for="name">Nome e cognome</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        @error('name')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <!-- Email -->
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        @error('email')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <!-- Password -->
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        @error('password')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <!-- Conferma Password -->
    <div class="form-group">
        <label for="password_confirmation">Conferma Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
    </div>

    <!-- lavoro -->
    <div class="form-group">
        <label for="lavoro">Lavoro</label>
        <input type="text" name="lavoro" id="lavoro" required>
        @error('lavoro')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <!---img--->
    <div class="form-group">
        <label for="img_url">Immagine del profilo</label>
        <input type="file" name="img_url" id="img_url" accept="image/*">
        @error('img_url')<div class="text-danger">{{ $message }}</div>@enderror
    </div>
    


    <!-- Bottone di Submit -->
    <div class="form-submit">
        <button type="submit">Registrati</button>
    </div>

    <!-- Link di Login -->
    <div class="text-center">
        <a href="{{ route('login') }}">Hai già un account? Accedi</a>
    </div>
</form>

