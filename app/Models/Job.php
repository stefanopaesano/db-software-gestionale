<?php

namespace App\Models;

use App\Models\Cliente;
use App\Models\Tecnico;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';

    protected $fillable = [
        'title',
        'description',
        'location',
        'tecnico_id',
        'cliente_id',
        'descrizione_lavoro',
        'data_lavoro',
        'data_inizio', 
        'data_fine',
        'diritto_chiamata'
    ];

    // Relazione con il tecnico 
    public function technician()
    {
        return $this->belongsTo(Tecnico::class, 'tecnico_id');
    }

    // Definizione della relazione con il cliente
    public function client()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
