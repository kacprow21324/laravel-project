<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rola extends Model
{
    use HasFactory;

    protected $table = 'role';

    protected $fillable = [
        'nazwa',
    ];

    public function uzytkownicy()
    {
        return $this->hasMany(Uzytkownik::class, 'rola_id');
    }
}
