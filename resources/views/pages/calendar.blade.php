<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> i miei lavori</title>
    
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

    <h2 class="list-title">IL NOSTRO CALENDARIO</h2>

    <div id="calendar"></div>

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
                            backgroundColor: getEventColor("{{ $job->diritto_chiamata }}"), // Colore dinamico in base al diritto di chiamata
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
                return '#FF5733';  // Colore rosso per "Sì"
            }
            return '#28a745';  // Colore verde per "No"
        }
    </script>

@endsection
