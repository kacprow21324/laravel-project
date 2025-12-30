<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adres extends Model
{
    use HasFactory;

    protected $table = 'adresy';

    protected $fillable = [
        'miasto',
        'ulica',
        'nr_domu',
        'kod_pocztowy',
    ];

    public function uzytkownicy()
    {
        return $this->hasMany(Uzytkownik::class, 'adres_id');
    }
}
