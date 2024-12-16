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

<div class="ticket">

    @if(isset($job))

        <h1>Info Lavoro</h1>

        <div class="section">
            <label>Titolo del Lavoro:</label>
            <label class="value">{{ $job->title }}</label>
        </div>

        <div class="section">
            <label>Tecnico:</label>
            <label class="value">{{ $job->technician->nome }} {{ $job->technician->cognome }}</label>
        </div>

        <div class="section">
            <label>Cliente:</label>
            <label class="value">{{ $job->client->nome }} {{ $job->client->cognome }}</label>
        </div>

        <div class="section">
            <label>Descrizione:</label>
            <label class="value">{{ $job->description }}</label>
        </div>

        <div class="section">
            <label>Locazione:</label>
            <label class="value">{{ $job->location }}</label>
        </div>

        <div class="section">
            <label>Data del Lavoro:</label>
            <label class="value">{{ $job->data_lavoro }}</label>
        </div>

        <div class="section">
            <label>Orario Inizio:</label>
            <label class="value">{{ $job->data_inizio }}</label>
        </div>

        <div class="section">
            <label>Orario Fine:</label>
            <label class="value">{{ $job->data_fine }}</label>
        </div>

        <div class="section">
            <label>Descrizione del Lavoro:</label>
            <label class="value">{{ $job->descrizione_lavoro }}</label>
        </div>

        <div class="section">
            <label>Diritto di Chiamata:</label>
            <label class="value">{{ $job->diritto_chiamata }}</label>
        </div>

        <div class="ticket-footer">
            <form action="{{ route('jobs.generatePdf', $job->id) }}" method="GET">
                <button type="submit">Stampa Biglietto</button>
            </form>
        </div>
        

    @elseif(isset($tecnico))

        <h1>Scheda Tecnico</h1>

        <div class="section-tecnico">
            <label>Nome:</label>
            <label class="value">{{ $tecnico->nome }} {{ $tecnico->cognome }}</label>
        </div>

        <div class="section-tecnico">
            <label>Lavoro:</label>
            <label class="value">{{ $tecnico->lavoro }}</label>
        </div>

        <div class="section-tecnico">
            <label>Anno di Nascita:</label>
            <label class="value">{{ $tecnico->anno_nascita }}</label>
        </div>

    @endif

</div>


@endsection
