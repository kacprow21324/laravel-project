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
        Schema::create('wizyta_lek', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wizyta_id')->constrained('wizyty')->onDelete('cascade');
            $table->foreignId('lek_id')->constrained('leki')->onDelete('cascade');
            $table->integer('ilosc_zuzyta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wizyta_lek');
    }
};
