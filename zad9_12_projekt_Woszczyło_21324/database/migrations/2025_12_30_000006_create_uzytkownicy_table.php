<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('uzytkownicy', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adres_id')->constrained('adresy')->onDelete('cascade');
            $table->foreignId('rola_id')->constrained('role')->onDelete('cascade');
            $table->string('imie');
            $table->string('nazwisko');
            $table->string('email')->unique();
            $table->string('haslo');
            $table->string('telefon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uzytkownicy');
    }
};
