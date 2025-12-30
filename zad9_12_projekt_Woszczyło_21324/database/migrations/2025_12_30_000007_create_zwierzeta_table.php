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
        Schema::create('zwierzeta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uzytkownik_id')->constrained('uzytkownicy')->onDelete('cascade');
            $table->foreignId('gatunek_id')->constrained('gatunki')->onDelete('cascade');
            $table->string('imie');
            $table->date('data_urodzenia');
            $table->string('plec');
            $table->decimal('waga', 5, 2);
            $table->string('nr_czipa')->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zwierzeta');
    }
};
