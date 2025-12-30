<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usluga extends Model
{
    use HasFactory;

    protected $table = 'uslugi';

    protected $fillable = [
        'nazwa',
        'opis',
        'cena_aktualna',
        'czas_trwania_minuty',
    ];

    protected $casts = [
        'cena_aktualna' => 'decimal:2',
    ];

    public function wizyty()
    {
        return $this->belongsToMany(Wizyta::class, 'wizyta_usluga', 'usluga_id', 'wizyta_id')
            ->withPivot('cena_w_chwili_wizyty', 'ilosc')
            ->withTimestamps();
    }
}
