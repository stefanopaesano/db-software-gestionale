
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    
</head>

<body>
    <div class="ticket">

        @if(isset($job))

        <h1> Tabella Lavoro </h1>

        <table class="info-lavoro">
            <tr>
                <td><strong>Titolo del Lavoro:</strong></td>
                <td>{{ $job->title }}</td>
            </tr>
            <tr>
                <td><strong>Tecnico:</strong></td>
                <td>{{ $tecnico->nome }} {{ $tecnico->cognome }}</td>
            </tr>
            <tr>
                <td><strong>Cliente:</strong></td>
                <td>{{ $client->nome }} {{ $client->cognome }}</td>
            </tr>
            <tr>
                <td><strong>Descrizione:</strong></td>
                <td>{{ $job->description }}</td>
            </tr>
            <tr>
                <td><strong>Locazione:</strong></td>
                <td>{{ $job->location }}</td>
            </tr>
            <tr>
                <td><strong>Data del Lavoro:</strong></td>
                <td>{{ $job->data_lavoro }}</td>
            </tr>
            <tr>
                <td><strong>Orario Inizio:</strong></td>
                <td>{{ $job->data_inizio }}</td>
            </tr>
            <tr>
                <td><strong>Orario Fine:</strong></td>
                <td>{{ $job->data_fine }}</td>
            </tr>
            <tr>
                <td><strong>Descrizione del Lavoro:</strong></td>
                <td>{{ $job->descrizione_lavoro }}</td>
            </tr>
            <tr>
                <td><strong>Diritto di Chiamata:</strong></td>
                <td>{{ $job->diritto_chiamata }}</td>
            </tr>
        </table>

    @elseif(isset($tecnico))

        <h1>Scheda Tecnico</h1>

        <table class="scheda-tecnico">
            <tr>
                <td><strong>Nome:</strong></td>
                <td>{{ $tecnico->nome }} {{ $tecnico->cognome }}</td>
            </tr>
            <tr>
                <td><strong>Lavoro:</strong></td>
                <td>{{ $tecnico->lavoro }}</td>
            </tr>
            <tr>
                <td><strong>Anno di Nascita:</strong></td>
                <td>{{ $tecnico->anno_nascita }}</td>
            </tr>
        </table>

    @endif

    </div>

</body>

</html>


<style lang="scss">

.ticket {
    max-width: 350px;
    min-height: 600px;
    padding: 20px;
    margin: 50px auto;
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    
    color: #333;
    border: 2px solid black;
    background: linear-gradient(135deg, #f9f9f9, #ffffff);
}

.ticket h1 {
    text-align: center;
    font-size: 1.5rem;
    font-weight: bold;
    color: #2d2d2d;
    margin-bottom: 20px;
}

/* Stile per la tabella */
.info-lavoro {
    width: 100%;
    min-height: 600px;
    border-spacing: 0 20px;
    
}

.info-lavoro td:last-child {
    text-align: right;
}
.info-lavoro td:first-child {
    text-align: left;
}


td {
    padding: 10px;
    margin: 10px
    
}

strong {
    font-weight: bold;
    color: #333;
}

</style>
