<?php

namespace App\Http\Controllers;

use App\Models\Servizi;
use Illuminate\Http\Request;


class ServizioController extends Controller
{
    public function create(){
        return view('servizi.create');
    }

    public function store(Request $request)
    {
        // Validazione dei dati 
        $validate = $request->validate([
            'nome' => 'required|regex:/^[\pL\s]+$/u|max:255',
            'prezzo' => 'required|numeric|min:0.01|max:9999.99',
        ]);

        // Crea il servizio esclusivamente user
        Servizi::create([
            'nome' => $request->nome,
            'prezzo' => $request->prezzo,
        ]);

        // Redirect che manda il messaggio se il tecnico è stato aggiunto 
        return redirect()->route('servizi.index')->with('success', 'servizio aggiunto con successo!');
    }

    public function index()
    {

        $servizi = Servizi::all();
        //dd('passo da qui');
        return view('pages.servizi', compact('servizi'));
    }


    //form delle modifiche

    public function edit($id)
    {
        $servizio = Servizi::findOrFail($id);
        return view('pages.edit', compact('servizio'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'prezzo' => 'required|numeric|min:0.01|max:9999.99',
        ]);

        $servizio = Servizi::findOrFail($id);
        $servizio->update([
            'nome' => $request->nome,
            'prezzo' => $request->prezzo,
        ]);

        return redirect()->route('servizi.index')->with('success', 'Servizio aggiornato con successo!');
    }

    public function destroy($id)
    {
        $servizio = Servizi::findOrFail($id);
        $servizio->delete();

        return redirect()->route('servizi.index')->with('success', 'servizio eliminato con successo!');
    }
}
