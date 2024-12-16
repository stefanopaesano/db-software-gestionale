<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;





class AuthController extends Controller
{

    //login
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
      $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email'=> 'le credenziali sono errate'
        ])->onlyInput('email');

        
    }
    

    //logout
    
    public function logout(Request $request)
    {
        Auth::logout();  // questo Disconnette l'utente grazie alla funzione Auth
        $request->session()->invalidate();  // questo invece distrugge la sessione che hai validato all' utente, ricorda: spazio temporaneo dove vengono inseriti i dati del utente/ storage.
        $request->session()->regenerateToken();  // Rigenera il token CSRF., questo è il token beerer

        return redirect('/login');  
    }


    //formregister

    // Mostra il form di registrazione
    public function showRegistrationForm()
    {
        return view('register');
    }

    // Logica di registrazione
    public function register(Request $request)
    {
        // Validazione dei dati
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', 
            
        ]);

        
        

        // Crea l'utente
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'lavoro' => $request->lavoro,
            'password' => Hash::make($request->password),
            
        ]);

        // Effettua il login dell'utente appena registrato
        Auth::login($user);

        return redirect()->route('login');
    }

    
    

    
}
