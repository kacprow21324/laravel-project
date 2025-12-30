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
        Schema::create('wizyty', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lekarz_id')->constrained('uzytkownicy')->onDelete('cascade');
            $table->foreignId('zwierze_id')->constrained('zwierzeta')->onDelete('cascade');
            $table->dateTime('data_wizyty');
            $table->string('status');
            $table->text('opis_zgloszenia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wizyty');
    }
};
