<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wizyta extends Model
{
    use HasFactory;

    protected $table = 'wizyty';

    protected $fillable = [
        'lekarz_id',
        'zwierze_id',
        'data_wizyty',
        'status',
        'opis_zgloszenia',
    ];

    protected $casts = [
        'data_wizyty' => 'datetime',
    ];

    public function lekarz()
    {
        return $this->belongsTo(Uzytkownik::class, 'lekarz_id');
    }

    public function zwierze()
    {
        return $this->belongsTo(Zwierze::class, 'zwierze_id');
    }

    public function dokumentacjaMedyczna()
    {
        return $this->hasOne(DokumentacjaMedyczna::class, 'wizyta_id');
    }

    public function uslugi()
    {
        return $this->belongsToMany(Usluga::class, 'wizyta_usluga', 'wizyta_id', 'usluga_id')
            ->withPivot('cena_w_chwili_wizyty', 'ilosc')
            ->withTimestamps();
    }

    public function leki()
    {
        return $this->belongsToMany(Lek::class, 'wizyta_lek', 'wizyta_id', 'lek_id')
            ->withPivot('ilosc_zuzyta')
            ->withTimestamps();
    }
}
