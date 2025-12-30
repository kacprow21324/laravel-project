<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zwierze extends Model
{
    use HasFactory;

    protected $table = 'zwierzeta';

    protected $fillable = [
        'uzytkownik_id',
        'gatunek_id',
        'imie',
        'data_urodzenia',
        'plec',
        'waga',
        'nr_czipa',
    ];

    protected $casts = [
        'data_urodzenia' => 'date',
        'waga' => 'decimal:2',
    ];

    public function uzytkownik()
    {
        return $this->belongsTo(Uzytkownik::class, 'uzytkownik_id');
    }

    public function gatunek()
    {
        return $this->belongsTo(Gatunek::class, 'gatunek_id');
    }

    public function wizyty()
    {
        return $this->hasMany(Wizyta::class, 'zwierze_id');
    }
}
