<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    protected $appends = ['data_zakonczenia', 'czas_trwania_minuty'];

    /**
     * Accessor - oblicza czas zakończenia wizyty na podstawie sumy czasu trwania usług.
     * Zwraca datę zakończenia jako Carbon lub null, jeśli brak usług.
     */
    public function getDataZakonczeniaAttribute(): ?Carbon
    {
        $sumaCzasu = $this->uslugi->sum('czas_trwania_minuty');
        
        // Jeśli brak usług, domyślnie dodajemy 30 minut
        if ($sumaCzasu == 0) {
            $sumaCzasu = 30;
        }
        
        return $this->data_wizyty ? $this->data_wizyty->copy()->addMinutes($sumaCzasu) : null;
    }

    /**
     * Accessor - zwraca całkowity czas trwania wizyty w minutach.
     */
    public function getCzasTrwaniaMinutyAttribute(): int
    {
        $sumaCzasu = $this->uslugi->sum('czas_trwania_minuty');
        
        return $sumaCzasu > 0 ? $sumaCzasu : 30;
    }

    /**
     * Helper - zwraca sformatowany zakres czasowy wizyty np. "14:00 - 14:45".
     */
    public function getZakresCzasowyAttribute(): string
    {
        $start = $this->data_wizyty ? $this->data_wizyty->format('H:i') : '--:--';
        $koniec = $this->data_zakonczenia ? $this->data_zakonczenia->format('H:i') : '--:--';
        
        return "{$start} - {$koniec}";
    }

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
