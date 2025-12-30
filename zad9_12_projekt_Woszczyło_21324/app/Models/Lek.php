<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lek extends Model
{
    use HasFactory;

    protected $table = 'leki';

    protected $fillable = [
        'nazwa',
        'jednostka',
        'ilosc_na_stanie',
        'cena_jednostkowa',
    ];

    protected $casts = [
        'cena_jednostkowa' => 'decimal:2',
    ];

    public function wizyty()
    {
        return $this->belongsToMany(Wizyta::class, 'wizyta_lek', 'lek_id', 'wizyta_id')
            ->withPivot('ilosc_zuzyta')
            ->withTimestamps();
    }
}
