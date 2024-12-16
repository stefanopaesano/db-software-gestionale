<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    
    public function showProfile()
    {
        $user = Auth::user(); // prendiamo solo l'utente autenticato GRAZIE A AUTH
        return view('profile', compact('user')); 
    }

    // Mostra il form per modificare il profilo
    

    // Gestisce l'aggiornamento del profilo
    public function update(Request $request)
    {
        $user = Auth::user(); 

        // Verifica che l'oggetto $user sia una corretta istanza di User
        if (!$user instanceof User) {
            abort(404, 'User not found');
        }

        // Validazione dei dati
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', 
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, 
            'lavoro' => 'required|string|max:255', 
            'password' => 'nullable|string|min:8|confirmed', 
        ]);

        // Aggiorna i dati dell'utente
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->lavoro = $validatedData['lavoro'];

        //solo quando ne viene inserita una nuova (filled)
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        // Salva le modifiche nel database
        $user->save();  // dd  Questo è il punto dove si verifica l'errore

        
        return redirect()->route('profile.update')->with('success', 'Profilo aggiornato con successo!');
    }
}