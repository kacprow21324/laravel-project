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
        Schema::create('wizyta_usluga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wizyta_id')->constrained('wizyty')->onDelete('cascade');
            $table->foreignId('usluga_id')->constrained('uslugi')->onDelete('cascade');
            $table->decimal('cena_w_chwili_wizyty', 10, 2);
            $table->integer('ilosc')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wizyta_usluga');
    }
};
