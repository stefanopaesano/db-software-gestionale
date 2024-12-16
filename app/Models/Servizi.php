<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servizi extends Model
{
    use HasFactory;
    /* public function tecnico()
    {
        
    } */
    protected $table = 'servizi';

    protected $fillable = ['nome', 'prezzo'];

}
