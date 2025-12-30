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
        Schema::create('leki', function (Blueprint $table) {
            $table->id();
            $table->string('nazwa');
            $table->string('jednostka');
            $table->integer('ilosc_na_stanie');
            $table->decimal('cena_jednostkowa', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leki');
    }
};
