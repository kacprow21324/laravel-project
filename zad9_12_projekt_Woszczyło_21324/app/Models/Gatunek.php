<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gatunek extends Model
{
    use HasFactory;

    protected $table = 'gatunki';

    protected $fillable = [
        'nazwa',
    ];

    public function zwierzeta()
    {
        return $this->hasMany(Zwierze::class, 'gatunek_id');
    }
}
