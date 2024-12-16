<?php

namespace App\Http\Controllers;

use App\Models\Tecnico;
use Illuminate\Http\Request;

class TecnicoController extends Controller
{
    //mostra form di modifa 

    public function create()
    {
        return view('tecnici.create');
    }

    // Salva il nuovo tecnico
    public function store(Request $request)
    {
        
        $request->validate([
            'nome' => 'required|regex:/^[\pL\s]+$/u|max:255',
            'cognome' => 'required|regex:/^[\pL\s]+$/u|max:255',
            'lavoro' => 'required|max:255', 
            'anno_nascita' => 'required|date|', 
        ]);

       
        Tecnico::create([
            'nome' => $request->nome,
            'cognome' => $request->cognome,
            'lavoro' => $request->lavoro,  
            'anno_nascita' => $request->anno_nascita,  
        ]);

        // Redirect con messaggio di successo
        return redirect()->route('tecnici.index')->with('success', 'Tecnico aggiunto con successo!');
    }

    // Mostra l'elenco di tutti i tecnici
    public function index()
    {
        $tecnici = Tecnico::all();
        
        return view('pages.tecnici', compact('tecnici'));
    }

    // Mostra il form di modifica
    public function edit($id)
    {
        $tecnici = Tecnico::findOrFail($id);
        return view('pages.edit', compact('tecnici'));
    }

    // Aggiorna i dati di un tecnico
    public function update(Request $request, $id)
    {
       
        $request->validate([
            'nome' => 'required|max:255',
            'cognome' => 'required',
            'lavoro' => 'required|max:255',  
            'anno_nascita' => 'required|date|',  
        ]);

        // Trova il tecnico e aggiorna i dati
        $tecnici = Tecnico::findOrFail($id);
        $tecnici->update([
            'nome' => $request->nome,
            'cognome' => $request->cognome,
            'lavoro' => $request->lavoro,  
            'anno_nascita' => $request->anno_nascita,  
        ]);

        // Redirect con messaggio di successo
        return redirect()->route('tecnici.index')->with('success', 'Tecnico aggiornato con successo!');
    }

    // Elimina un tecnico
    public function destroy($id)
    {
        $tecnico = Tecnico::findOrFail($id);
        $tecnico->delete();

        return redirect()->route('tecnici.index')->with('success', 'Tecnico eliminato con successo!');
    }

    public function show($id){

        $tecnico = Tecnico::find($id);
        if ($tecnico) {
            return view('pages.show', compact('tecnico'));
        }
    }
}
