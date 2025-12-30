<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumentacjaMedyczna extends Model
{
    use HasFactory;

    protected $table = 'dokumentacje_medyczne';

    protected $fillable = [
        'wizyta_id',
        'diagnoza',
        'zalecenia',
        'temperatura',
    ];

    protected $casts = [
        'temperatura' => 'decimal:2',
    ];

    public function wizyta()
    {
        return $this->belongsTo(Wizyta::class, 'wizyta_id');
    }
}
