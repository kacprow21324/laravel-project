<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Zmienia kolumnę adres_id na nullable w tabeli uzytkownicy.
     */
    public function up(): void
    {
        // Użyj raw SQL, aby uniknąć zależności od Doctrine DBAL
        DB::statement('ALTER TABLE uzytkownicy MODIFY adres_id BIGINT UNSIGNED NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE uzytkownicy MODIFY adres_id BIGINT UNSIGNED NOT NULL');
    }
};
