<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giotto s.r.l software / i miei lavori</title>
    <link rel="icon" href="https://th.bing.com/th/id/OIP.tjM-Lo2m8fheM7GYQySfUgHaEK?rs=1&pid=ImgDetMain" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @vite('resources/js/app.js')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.css" rel="stylesheet">

    <!-- jQuery (necessario per FullCalendar) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.js"></script>



</head>

@extends('layouts.app')

@section('content')

    {{-- form di assegnazione lavoro  --}}

    <h2 style="text-align: center; color: white">ASSEGNA IL TUO LAVORO </h2>

    <form class="form-jobs" action="{{ route('jobs.store') }}" method="POST">
        @csrf
    
        <div class="form-group">
            <label for="tecnico_id">Seleziona il Tecnico:</label>
            <select name="tecnico_id" id="tecnico_id" class="form-control" required>
                @foreach ($tecnici as $tecnico)
                    <option value="{{ $tecnico->id }}">{{ $tecnico->nome }} {{ $tecnico->cognome }}</option>
                @endforeach
            </select>
            @error('tecnico_id')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="form-group">
            <label for="cliente_id">Seleziona il Cliente:</label>
            <select name="cliente_id" id="cliente_id" class="form-control" required>
                @foreach ($clienti as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nome }} {{ $cliente->cognome }}</option>
                @endforeach
            </select>
            @error('cliente_id')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="form-group">
            <label for="description">Descrizione:</label>
            <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="form-group">
            <label for="location">Locazione:</label>
            <textarea name="location" id="location" class="form-control" required>{{ old('location') }}</textarea>
            @error('location')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="form-group">
            <label for="title">Titolo del Lavoro:</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required>
            @error('title')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="form-group">
            <label for="descrizione_lavoro">Descrizione del Lavoro:</label>
            <textarea name="descrizione_lavoro" id="descrizione_lavoro" class="form-control" required></textarea>
            @error('descrizione_lavoro')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="form-group">
            <label for="data_lavoro">Data del Lavoro:</label>
            <input type="date" name="data_lavoro" id="data_lavoro" class="form-control-data" required>
            <input type="time" name="orario_inizio" id="orario_inizio" class="form-control" required>
            <input type="time" name="orario_fine" id="orario_fine" class="form-control" required>
            @error('data_lavoro')
                <div class="error-message">{{ $message }}</div>
            @enderror

            @error('orario_inizio')
                <div class="error-message">{{ $message }}</div>
            @enderror

            @error('orario_fine')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="button-for-assigned">
            
            <button type="submit">Assegna Lavoro</button>

            <div>
                <label for="diritto_chiamata">Diritto di Chiamata:</label>
                <select name="diritto_chiamata" id="diritto_chiamata" class="form-control" required>
                    <option value="si" {{ old('diritto_chiamata', $job->diritto_chiamata ?? '') == 'si' ? 'selected' : '' }}>Sì</option>
                    <option value="no" {{ old('diritto_chiamata', $job->diritto_chiamata ?? '') == 'no' ? 'selected' : '' }}>No</option>
                </select>
                @error('diritto_chiamata')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            
        </div>
        
    </form>



    <h2 class="list-title">LISTA DI TUTTI I LAVORI</h2>


    <div class="groupCalendar">
        <div class="date-filter">
            <form action="{{ route('jobs.index') }}" method="GET">
                <div>
                    <label for="data_lavoro">Seleziona la data:</label>
                    <input type="date" name="data_lavoro" id="data_lavoro"   value="{{ request('data_lavoro') }}">
                    <button type="submit">Filtra</button>
                </div>
            </form>
        </div>
    
        <div class="linksforcalendar">
            <button>
                <a href="{{ route('calendar') }}">Calendario</a> 
            </button>
        </div>
    </div>



    <div class="table-jobs">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Tecnico</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Luogo</th>
                        <th scope="col">Data lavoro</th>
                        <th scope="col">orario di inizio Lavoro</th>
                        <th scope="col">orario di fine Lavoro</th>
                        <th scope="col">Descrizione Lavoro</th>
                        <th scope="col">diritto di chiamata</th>
                        <th scope="col">modifica</th>
                        <th scope="col">elimina</th> 
                        <th>stampa lavoro</th>
                        
                        
                        
                    </tr>
                </thead>    
                
                <tbody>

                    @foreach ($jobs as $job)
                        <tr>
                            <td> {{ $job->technician->nome }} {{ $job->technician->cognome }} </td> 
                            <td>{{ $job->client->nome }} {{ $job->client->cognome }}</td> 
                            <td>{{ $job->description }}</td>
                            <td>{{ $job->location }}</td>
                            <td>{{ $job->data_lavoro}}</td> 
                            <td>{{$job->data_inizio}}</td>
                            <td>{{$job->data_fine}}</td>
                            <td>{{ $job->descrizione_lavoro }}</td> 
                            <td>{{$job->diritto_chiamata}}</td>
                            <td>
                                <!-- Bottone di Modifica -->
                                <a href="{{ route('jobs.edit', ['id' => $job->id]) }}" class="btn btn-warning">Modifica</a>
                            </td>
                            <td>
                                <form action="{{ route('jobs.destroy', $job->id) }}" 
                                    method="POST" 
                                    onsubmit="return confirm('Vuole davvero eliminare questo lavoro? non potrà aggiungerlo di nuovo!');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Elimina</button>
                                </form>
                            </td>
                            <td>
                                <!-- Bottone per Visualizzare il lavoro -->
                                <a href="{{ route('jobs.show', ['id' => $job->id]) }}" class="btn btn-info">Visualizza</a>
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>


    {{-- <h2 class="list-title">IL NOSTRO CALENDARIO</h2>


    <div id="calendar">

        <script>

            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
        
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',  // visualizza la vista mese per impostazione predefinita
                    events: [
                        @foreach($jobs as $job)
                            {
                                title: "{{ $job->client->nome }} {{ $job->client->cognome }}",
                                start: "{{ $job->data_lavoro }}T{{ $job->data_inizio }}",  // data e orario di inizio
                                end: "{{ $job->data_lavoro }}T{{ $job->data_fine }}",    // data e orario di fine
                                description: "{{ $job->description }}",
                                url: "{{ route('jobs.show', ['id' => $job->id]) }}",  // Link per visualizzare i dettagli del lavoro
                                backgroundColor: getEventColor("{{ $job->diritto_chiamata }}"), // Aggiungi colore dinamico
                                textColor: "#ffffff"  // Colore del testo dell'evento (bianco)
                            },
                        @endforeach
                    ],
                    eventClick: function(info) {
                        // Quando un evento viene cliccato, apri il link dell'evento
                        window.location = info.event.url;
                    }
                });
        
                calendar.render();
            });
        
            // Funzione per determinare il colore dell'evento in base al diritto di chiamata
            function getEventColor(dirittoChiamata) {
                if (dirittoChiamata.toLowerCase() === 'si') {
                    return '#FF5733'; 
                }
                return '#28a745'; 
            }

        </script>

    </div> --}}

    


@endsection