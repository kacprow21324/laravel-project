<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uzytkownik extends Model
{
    use HasFactory;

    protected $table = 'uzytkownicy';

    protected $fillable = [
        'adres_id',
        'rola_id',
        'imie',
        'nazwisko',
        'email',
        'haslo',
        'telefon',
    ];

    protected $hidden = [
        'haslo',
    ];

    public function adres()
    {
        return $this->belongsTo(Adres::class, 'adres_id');
    }

    public function rola()
    {
        return $this->belongsTo(Rola::class, 'rola_id');
    }

    public function zwierzeta()
    {
        return $this->hasMany(Zwierze::class, 'uzytkownik_id');
    }

    public function wizytyJakoLekarz()
    {
        return $this->hasMany(Wizyta::class, 'lekarz_id');
    }
}
