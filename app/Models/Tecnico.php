<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    use HasFactory;

    protected $table = 'tecnici';

    protected $fillable = ['nome', 'cognome', 'anno_nascita','lavoro'];


    public function jobs()
    {
        return $this->hasMany(Job::class, 'tecnici_id');
    }

    
}
