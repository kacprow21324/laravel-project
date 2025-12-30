<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Uzytkownik extends Authenticatable
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

    /**
     * Get the password for the user (dla Laravel Auth).
     */
    public function getAuthPassword()
    {
        return $this->haslo;
    }

    /**
     * Sprawdza czy użytkownik jest adminem.
     */
    public function isAdmin(): bool
    {
        return $this->rola_id === 1;
    }

    /**
     * Sprawdza czy użytkownik jest weterynarzem.
     */
    public function isWeterynarz(): bool
    {
        return $this->rola_id === 2;
    }

    /**
     * Sprawdza czy użytkownik jest klientem.
     */
    public function isKlient(): bool
    {
        return $this->rola_id === 3;
    }

    /**
     * Sprawdza czy użytkownik jest pracownikiem (admin lub weterynarz).
     */
    public function isPracownik(): bool
    {
        return $this->isAdmin() || $this->isWeterynarz();
    }

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
