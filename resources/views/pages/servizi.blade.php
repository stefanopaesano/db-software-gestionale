<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> i miei servizi</title>
    
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

@extends('layouts.app')

@section('content')
<div class="title">
    <h1>AGGIUNGI UN NUOVO SERVIZIO</h1>
</div>


<!-- Form per aggiungere un tecnico -->

<form   class="form-tecnici"   action="{{ route('servizi.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nome">Nome servizio:</label>
        <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}" required>

        @error('nome')
             <div class="alert alert-danger">{{ $message }}</div>
        @enderror

    </div>

    <div class="form-group">
        <label for="cognome">prezzo servizio:</label>
        <input type="text" id="prezzo" name="prezzo" class="form-control" value="{{ old('prezzo') }}">

        @error('prezzo')
            <div class="alert alert-danger m-10">{{ $message }}</div>
        @enderror

    </div>

    <button type="submit">Aggiungi servizio</button>

</form>

<!-- Messaggio di successo-->
@if(session('success'))
    <div class="alert">
        {{ session('success') }}
    </div>
@endif




<!-- Lista dei Tecnici -->
<h2 class="list-title">LISTA DEI SERVIZI</h2>

<div class="table-tecnici">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">prezzo</th>
                    <th scope="col">Modifica servizi</th>
                    <th scope="col">Elimina servizi</th> 
                </tr>
            </thead>
            <tbody>
                @foreach ($servizi as $servizio)
                    <tr>
                        <td>{{ $servizio->nome }}</td>
                        <td>{{ $servizio->prezzo }}€</td>
                        <td>
                            <!-- Bottone Modifica -->
                            <a href="{{ route('servizi.edit', $servizio->id) }}" class="btn btn-warning">
                                Modifica
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('servizi.destroy', $servizio->id) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questo servizio?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Elimina</button>
                            </form>
                        </td>
                        
                    </tr>
                @endforeach
    
            </tbody>
        </table>
    </div>
    
</div>

@endsection