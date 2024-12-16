<?php
use App\Http\Controllers\TecnicoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ServizioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Models\Tecnico;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rotte per il login 
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);




//rotta per il logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); 




//rotta per la registrazione 
Route::get('/', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/', [AuthController::class, 'register'])->name('register');








// Rotta per visualizzare il profilo
Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');

// Aggiorna il profilo (questo è il form che invia i dati)
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');





//rotta per la Home, ricorda: il middelware fa si che se sei autenticato ti porta alla home page
Route::get('/home', function () {
    return view('pages.home');  
})->middleware('auth')->name('home');






// Rotte per i tecnici
Route::middleware('auth')->group(function () {
    // Mostra il form per aggiungere un tecnico
    Route::get('/tecnici', [TecnicoController::class, 'create'])->name('tecnici.create');
    
    // Salva il tecnico nel database
    Route::post('/tecnici', [TecnicoController::class, 'store'])->name('tecnici.store');
    
    // Visualizza la lista dei tecnici
    Route::get('/tecnici', [TecnicoController::class, 'index'])->name('tecnici.index');

    Route::get('tecnici/{id}', [TecnicoController::class, 'show'])->name('tecnici.show');

    Route::get('tecnici/{id}/edit', [TecnicoController::class, 'edit'])->name('tecnici.edit');

    Route::put('tecnici/{id}', [TecnicoController::class, 'update'])->name('tecnici.update');

    Route::delete('tecnici/{id}', [TecnicoController::class, 'destroy'])->name('tecnici.destroy');
});





// rotte per i jobs
Route::middleware('auth')->group(function () {

    Route::get('/jobs', [JobsController::class, 'index'])->name('jobs.index');

    Route::post('/jobs/create', [JobsController::class, 'create'])->name('jobs.create');

    Route::post('/jobs', [JobsController::class, 'store'])->name('jobs.store');

    Route::get('jobs/{id}', [JobsController::class, 'show'])->name('jobs.show');

    Route::get('/calendar', [JobsController::class, 'calendar'])->name('calendar');

    Route::get('jobs/{id}/edit', [JobsController::class, 'edit'])->name('jobs.edit');
    
    Route::put('jobs/{id}', [JobsController::class, 'update'])->name('jobs.update');

    Route::delete('jobs/{id}', [JobsController::class, 'destroy'])->name('jobs.destroy');

    Route::get('/jobs/{id}/generate-pdf', [JobsController::class, 'generatePdf'])->name('jobs.generatePdf');
    
});


//rotte per i clienti 
Route::middleware('auth')->group(function () {
    // Mostra il form per aggiungere un cliente
    Route::get('/clienti', [ClienteController::class, 'create'])->name('clienti.create');
    
    // Salva il Cliente nel database
    Route::post('/clienti', [ClienteController::class, 'store'])->name('clienti.store');
    
    // Visualizza la lista dei clienti
    Route::get('/clienti', [ClienteController::class, 'index'])->name('clienti.index');
    
    // Per i clienti
    Route::get('clienti/{id}/edit', [ClienteController::class, 'edit'])->name('clienti.edit');

    Route::put('clienti/{id}', [ClienteController::class, 'update'])->name('clienti.update');

    Route::delete('clienti/{id}', [ClienteController::class, 'destroy'])->name('clienti.destroy');

});





// Rotte per i Servizi

Route::middleware('auth')->group(function () {
    
    Route::get('/servizi/create', [ServizioController::class, 'create'])->name('servizi.create');
    
    
    Route::post('/servizi', [ServizioController::class, 'store'])->name('servizi.store');
    
  
    Route::get('/servizi', [ServizioController::class, 'index'])->name('servizi.index');

    
    Route::get('servizi/{id}/edit', [ServizioController::class, 'edit'])->name('servizi.edit');

    
    Route::put('servizi/{id}', [ServizioController::class, 'update'])->name('servizi.update');

    
    Route::delete('servizi/{id}', [ServizioController::class, 'destroy'])->name('servizi.destroy');
});



