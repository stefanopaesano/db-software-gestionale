<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    //form di creazione
    public function create(){
        return view('clienti.create');
    }

    

    public function store(Request $request)
    {
        // Validazione dei dati 
        $request->validate([
            'nome' => 'required|regex:/^[\pL\s]+$/u|max:255',
            'cognome' => 'required|regex:/^[\pL\s]+$/u|max:255',
        ]);

        // Crea il tecnico solo ed esclusivamente user
        Cliente::create([
            'nome' => $request->nome,
            'cognome' => $request->cognome,
        ]);

        // Redirect che manda il messaggio se il tecnico è stato aggiunto 
        return redirect()->route('clienti.index')->with('success', 'Cliente aggiunto con successo!');
    }
     //recupero tutti i clienti 
    public function index()
    {

        $clienti = Cliente::all();
        //dd('passo da qui');
        return view('pages.clienti', compact('clienti'));
    }


    // form di modifica 
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('pages.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|regex:/^[\pL\s]+$/u|max:255',
            'cognome' => 'required|regex:/^[\pL\s]+$/u|max:255',
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update([
            'nome' => $request->nome,
            'cognome' => $request->cognome,
        ]);

        return redirect()->route('clienti.index')->with('success', 'Cliente aggiornato con successo!');
    }

    //destroy form 
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clienti.index')->with('success', 'Cliente eliminato con successo!');
    }
   
}
