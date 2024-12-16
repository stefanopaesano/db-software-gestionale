<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> modifica</title>
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @vite('resources/js/app.js')
</head>

@extends('layouts.app')

@section('content')

    <div class="container-edit">

        <h1>Modifica {{ isset($cliente) ? 'Cliente' : (isset($tecnici) ? 'Tecnico' : (isset($job) ? 'Job' : 'Servizio')) }}</h1>
        
        <form   lass="form-edit"  action="{{ isset($cliente) ? route('clienti.update', $cliente->id) : (isset($tecnici) ? route('tecnici.update', $tecnici->id) : (isset($job) ? route('jobs.update', $job->id) : route('servizi.update', $servizio->id))) }}" method="POST">
            @csrf
            @method('PUT')

            @if(isset($cliente))

                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $cliente->nome) }}" required>
                </div>
                <div class="form-group">
                    <label for="cognome">Cognome</label>
                    <input type="text" name="cognome" id="cognome" class="form-control" value="{{ old('cognome', $cliente->cognome) }}" required>
                </div>

            @elseif(isset($tecnici))
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $tecnici->nome) }}" required>
                </div>
                <div class="form-group">
                    <label for="cognome">Cognome</label>
                    <input type="text" name="cognome" id="cognome" class="form-control" value="{{ old('cognome', $tecnici->cognome) }}" required>
                </div>

                <div class="form-group">
                    <label for="cognome">lavoro</label>
                    <input type="text" name="lavoro" id="lavoro" class="form-control" value="{{ old('lavoro', $tecnici->cognome) }}" required>
                </div>

                <div class="form-group">
                    <label for="cognome">anno_nascita</label>
                    <input type="date" name="anno_nascita" id="anno_nascita" class="form-control" value="{{ old('anno_nascita', $tecnici->cognome) }}" required>
                </div>

            @elseif(isset($job))

            <div class="form-group">
                <label for="description">Descrizione</label>
                <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $job->description) }}</textarea>
                @error('description')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            

            <!-- Campo Location -->
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $job->location) }}" required>
                @error('location')
                      <div class="error-message">{{ $message }}</div>
                 @enderror
            </div>

            <!-- Campo Descrizione Lavoro -->
            <div class="form-group">
                <label for="descrizione_lavoro">Descrizione Lavoro</label>
                <textarea name="descrizione_lavoro" id="descrizione_lavoro" class="form-control" rows="4" required>{{ old('descrizione_lavoro', $job->descrizione_lavoro) }}</textarea>
                @error('descrizione_lavoro')
                     <div class="error-message">{{ $message }}</div>
                 @enderror
            </div>

            <!-- Campo Data Lavoro -->
            <div class="form-group">
                <label for="data_lavoro">Data Lavoro</label>
                <input type="date" name="data_lavoro" id="data_lavoro" class="form-control" value="{{ old('data_lavoro', $job->data_lavoro) }}" required>
                @error('data_lavoro')
                      <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="data_inizio">Orario Inizio</label>
                <input type="time" name="data_inizio" id="data_inizio" class="form-control" value="{{ old('data_inizio', $job->data_inizio) }}" required>
                @error('data_inizio')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="data_fine">Orario Fine</label>
                <input type="time" name="data_fine" id="data_fine" class="form-control" value="{{ old('data_fine', $job->data_fine) }}" required>
                @error('data_fine')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="diritto_chiamata">Diritto di Chiamata:</label>
                <select name="diritto_chiamata" id="diritto_chiamata" class="form-control" required>
                    <option value="si" {{ old('diritto_chiamata', $job->diritto_chiamata ?? '') == 'si' ? 'selected' : '' }}>Sì</option>
                    <option value="no" {{ old('diritto_chiamata', $job->diritto_chiamata ?? '') == 'no' ? 'selected' : '' }}>No</option>
                </select>
                @error('diritto_chiamata')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            @elseif(isset($servizio))

                <div class="form-group">
                    <label for="nome">Nome Servizio</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $servizio->nome) }}" required>
                </div>
                <div class="form-group">
                    <label for="prezzo">prezzo</label>
                    <input type="number"   name="prezzo" id="prezzo" class="form-control" required>{{ old('prezzo', $servizio->prezzo) }}</input>
                </div>
            @endif

            <button type="submit" class="btn btn-primary">Salva modifiche</button>
        </form>
    </div>
@endsection
