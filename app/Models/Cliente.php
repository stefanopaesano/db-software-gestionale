<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clienti';
    
    protected $fillable = ['nome', 'cognome'];

    public function jobs()
    {
        return $this->hasMany(Job::class, 'clienti_id');
    }
}
