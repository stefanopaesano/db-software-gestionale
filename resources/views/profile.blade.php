<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Il mio Profilo</title>
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @vite('resources/js/app.js')
</head>
<body>

@extends('layouts.app')

@section('content')

    <div class="profile-container">  

        <h1>Profilo di {{ $user->name }}</h1>

        <div class="profile-info">
            <p><strong>Nome:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Password:</strong> ***** (la password non viene mostrata per motivi di sicurezza)</p>
            <p><strong>Lavoro:</strong> {{ $user->lavoro }}</p>
            <p><strong>Data di registrazione:</strong> {{ $user->created_at->format('d/m/Y') }}</p>

            <!-- Puoi aggiungere altre informazioni qui -->
        </div>


        <a href="{{ route('home') }}">Torna alla home</a>
    </div>



    


    <form  class="form_profile"  action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <h1>Aggiorna i tuoi dati</h1>

        <!-- Nome -->
        <div  class="form-group-profile">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group-profile">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Lavoro -->
        <div class="form-group-profile">
            <label for="lavoro">Lavoro:</label>
            <input type="text" id="lavoro" name="lavoro" value="{{ old('lavoro', $user->lavoro) }}" required>
            @error('lavoro')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->

        
        <div class="form-group-profile">
            <label for="password">Nuova Password:</label>
            <input type="password" id="password" name="password">
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Conferma Password -->
        <div class="form-group-profile">
            <label for="password_confirmation">Conferma Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit">Aggiorna Profilo</button>

       
        
    </form>

    

@endsection

    
