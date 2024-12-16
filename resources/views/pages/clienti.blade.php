<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>i miei clienti</title>
    
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

@extends('layouts.app')

@section('content')

    <div class="title">
        <h1>AGGIUNGI UN NUOVO CLIENTE</h1>
    </div>
    

    <!-- Form per aggiungere un tecnico -->

    <form   class="form-tecnici"   action="{{ route('clienti.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome Cliente:</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}" required>
        </div>

        <div class="form-group">
            <label for="cognome">Cognome Cliente:</label>
            <input type="text" name="cognome" id="cognome" class="form-control" value="{{ old('cognome') }}" required>
        </div>

        <button type="submit" >Aggiungi cliente</button>
    </form>

    <!-- Messaggio di successo-->
    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif


    

    <!-- Lista dei Tecnici -->
    <h2 class="list-title">LISTA DEI CLIENTI</h2>

    <div class="table-tecnici">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Cognome</th>
                        <th scope="col">Modifica cliente</th>
                        <th scope="col">Elimina cliente</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clienti as $cliente)
                        <tr>
                            <td>{{ $cliente->nome }}</td>
                            
                            <td>{{ $cliente->cognome }}</td>

                            <td>
                                <!-- Bottone per modificare il cliente -->
                                <a href="{{ route('clienti.edit', ['id' => $cliente->id]) }}" class="btn btn-warning">Modifica</a>
                            </td>
            
                            <td>
                                <form action="{{ route('clienti.destroy', $cliente->id) }}" 
                                    method="POST" 
                                    onsubmit="return confirm('vuole davvero eliminare questo cliente?');">
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