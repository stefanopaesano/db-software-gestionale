<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

@extends('layouts.app')

@section('content')

    <div class="title">
        <h1>AGGIUNGI NUOVO TECNICO </h1>
    </div>
    

    <!-- Form per aggiungere un tecnico -->

    <form   class="form-tecnici"   action="{{ route('tecnici.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome Tecnico:</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}" required>
        </div>

        <div class="form-group">
            <label for="cognome">Cognome Tecnico:</label>
            <input type="text" name="cognome" id="cognome" class="form-control" value="{{ old('cognome') }}" required>
        </div>

        <div class="form-group">
            <label for="cognome">lavoro tecnico:</label>
            <input type="text" name="lavoro" id="lavoro" class="form-control" value="{{ old('lavoro') }}" required>
        </div>
        <div class="form-group">
            <label for="cognome">anno di nascita:</label>
            <input type="date" name="anno_nascita" id="anno_nascita" class="form-control" value="{{ old('anno_nascita') }}" required>
        </div>

        <button type="submit">Aggiungi Tecnico</button>
    </form>



    <!-- Messaggio di successo-->
    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif


    

    <!-- Lista dei Tecnici -->
    <h2 class="list-title">LISTA DEI TECNICI</h2>

    <div class="table-tecnici">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Cognome</th>
                        <th scope="col">Lavoro</th>
                        <th scope="col">anno di nascita</th>
                        <th scope="col">Modifica tecnico</th>
                        <th scope="col">Elimina tecnico</th> 
                        <th>visualizza tecnico</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tecnici as $tecnico)
                        <tr>
                            <td>{{ $tecnico->nome }}</td>
                            <td>{{ $tecnico->cognome }}</td>
                            <td>{{ $tecnico->lavoro }}</td>
                            <td>{{ $tecnico->anno_nascita }}</td>

                            <td>
                                <!-- Bottone per modificare il cliente -->
                                <a href="{{ route('tecnici.edit', ['id' => $tecnico->id]) }}" class="btn btn-warning">Modifica</a>
                            </td>
                            
                            <td>
                                <form action="{{ route('tecnici.destroy', $tecnico->id) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questo tecnico?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Elimina</button>
                                </form>
                            </td>

                            <td>
                                <!-- Bottone per Visualizzare il lavoro -->
                                <a href="{{ route('tecnici.show', ['id' => $tecnico->id]) }}" class="btn btn-info">Visualizza</a>

                            </td>
                        
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
       
    </div>



    
    
@endsection








