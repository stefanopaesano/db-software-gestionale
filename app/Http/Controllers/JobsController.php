<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Job;
use App\Models\Tecnico;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;




class JobsController extends Controller
{


    public function create()
    {
        // Ottieni tutti i tecnici e i clienti
        $tecnici = Tecnico::all();
        $clienti = Cliente::all();
        
        // Passa i dati alla vista
        return view('pages.jobs', compact('tecnici', 'clienti'));
    }

    // Memorizza il nuovo lavoro nel database
    public function store(Request $request)
    {

        $validate = $request->validate([
            'title' => 'required|string|max:255|unique:jobs',
            'description' => 'required|string|max:1000|regex:/^[a-zA-Z\s]*$/',  // No numeri
            'location' => 'required|string|max:40',
            'tecnico_id' => 'required|exists:tecnici,id',
            'cliente_id' => 'required|exists:clienti,id',
            'descrizione_lavoro' => 'required|string|max:500|regex:/^[a-zA-Z\s]*$/',  // No numeri
            'data_lavoro' => 'required|date|after_or_equal:today',
            'orario_inizio' => 'required|date_format:H:i',
             'orario_fine' => 'required|date_format:H:i|after:orario_inizio',
             'diritto_chiamata' => 'required|in:si,no',
        ], [
            'description.regex' => 'La descrizione non può contenere numeri.',
            'descrizione_lavoro.regex' => 'La descrizione del lavoro non può contenere numeri.',
            'title.string' => 'Il titolo del lavoro deve essere una stringa.',
            'data_lavoro.after_or_equal' => 'La data del lavoro deve essere uguale o successiva a oggi.',
            'location' => 'La location non può contenere pù di 20 caratteri',
            'orario_fine.required' => 'L\'orario di fine è obbligatorio.',
            'orario_fine.after' => 'L\'orario di fine deve essere successivo all\'orario di inizio.',
            'diritto_chiamata.in' => 'Il diritto di chiamata é oblbligatorio puoi scegliere "Sì" o "No".',
        ]);

        $orario_inizio = $request->input('orario_inizio'); // solo l'orario
        $orario_fine = $request->input('orario_fine');

        
        Job::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'), 
            'location' => $request->input('location'),
            'tecnico_id' => $request->input('tecnico_id'),
            'cliente_id' => $request->input('cliente_id'),
            'descrizione_lavoro' => $request->input('descrizione_lavoro'),
            'data_lavoro' => $request->input('data_lavoro'),
            'data_inizio' => $orario_inizio,
            'data_fine' => $orario_fine,
            'diritto_chiamata' => $request->input('diritto_chiamata'),
            
        ]);

        return redirect()->route('jobs.index')->with('success', 'Lavoro assegnato con successo!');
    }


        public function index(Request $request)
    {
        // Inizialmente recupera tutti i lavori con le associazioni
        $jobs = Job::with(['technician', 'client']);

        // Se c'è un filtro per la data, lo applica
        if ($request->has('data_lavoro') && !empty($request->input('data_lavoro'))) {
            $jobs = $jobs->whereDate('data_lavoro', $request->input('data_lavoro'));
        }

        // Esegui la query e recupera i lavori
        $jobs = $jobs->get();
        
        // Recupera tutti i tecnici e i clienti (per poterli visualizzare nel template)
        $tecnici = Tecnico::all();
        $clienti = Cliente::all();
        
        // Passa i dati alla vista
        return view('pages.jobs', compact('jobs', 'tecnici', 'clienti'));
    }


    //calendario 
    
    public function calendar()
    {
        // Ottieni i lavori dal database
        $jobs = Job::with('client')->get(); 

        // Passa i lavori alla vista del calendario
        return view('pages.calendar', compact('jobs'));
    }



    //show seleziona 1 

    public function show($id)
    {
        $job = Job::with(['technician', 'client'])->findOrFail($id); // Trova il lavoro con le relazioni

        return view('pages.show', compact('job')); // Passa il lavoro alla vista
    }

    


    // modifica

    public function edit($id)
    {
        $job = Job::findOrFail($id);
        return view('pages.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string|max:1000|regex:/^[a-zA-Z\s]*$/',  
            'location' => 'required|string|max:25',
            'descrizione_lavoro' => 'required|string|max:500|regex:/^[a-zA-Z\s]*$/',  
            'data_lavoro' => 'required|date|after_or_equal:today',
            'data_inizio' => 'required|',
            'data_fine' => 'required|after:data_inizio',
            'diritto_chiamata' => 'required|in:si,no',
        ],
        [
            'description.regex' => 'La descrizione non può contenere numeri.',
            'descrizione_lavoro.regex' => 'La descrizione del lavoro non può contenere numeri.',
            'title.string' => 'Il titolo del lavoro deve essere una stringa.',
            'data_lavoro.after_or_equal' => 'La data del lavoro deve essere uguale o successiva a oggi.',
            'location' => 'La location non può contenere pù di 20 caratteri',
            'data_inizio.required' => 'L\'orario di inizio è obbligatorio.',
            'data_fine.after' => 'L\'orario di fine deve essere successivo all\'orario di inizio.',
            'diritto_chiamata.in' => 'Il diritto di chiamata é oblbligatorio puoi scegliere "Sì" o "No".',

            
        ]);

        

        $job = Job::findOrFail($id);
        $job->update([
            'description' => $request->description,
            'location' => $request->location,
            'descrizione_lavoro' => $request->descrizione_lavoro,
            'data_lavoro' => $request->data_lavoro,
            'data_inizio'=> $request->data_inizio,  // Assicurati che questo campo venga passato correttamente
            'data_fine' => $request->data_fine,
            'diritto_chiamata' => $request->input('diritto_chiamata'),
            
        ]);


        return redirect()->route('jobs.index')->with('success', 'job aggiornato con successo!');
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'lavoro eliminato con successo!');
    }


    //regole per pdf

    public function generatePdf($id)
    {
        // Recupera il lavoro, tecnico e cliente
        $job = Job::findOrFail($id);  
        $tecnico = Tecnico::find($job->tecnico_id); 
        $client = Cliente::find($job->cliente_id);  
    
        // Verifica se tecnico e cliente esistono
        if (!$tecnico || !$client) {
            return redirect()->back()->with('error', 'Tecnico o Cliente non trovati.');
        }
    
        // Passa i dati alla vista
        $pdfContent = view('job_pdf', compact('job', 'tecnico', 'client'))->render();  // render() per ottenere il contenuto HTML
    
        
    
        // Inizializza Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true); // Abilita l'uso del parser HTML5
        $options->set('isPhpEnabled', true); // Consente l'esecuzione di codice PHP all'interno del file HTML5
        $dompdf = new Dompdf($options); // Carichiamo il contenuto HTML nel parser Dompdf per trasformarlo in PDF
    
        // Carica il contenuto HTML
        $dompdf->loadHtml($pdfContent);
    
        // Impostare le dimensioni della pagina
        $dompdf->setPaper('A4', 'portrait');
    
        // Renderizza il PDF
        $dompdf->render();

        // return view('job_pdf', compact('job', 'tecnico', 'client'))->render();
    
        // Stream il PDF nel browser con le intestazioni corrette, il PDF viene restituito come risposta HTTP
        return response($dompdf->output())// il metodo output() restituisce il contenuto del PDF in formato binario.
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="lavoro_'.$job->title.'.pdf"');
    }

}