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
        Schema::create('adresy', function (Blueprint $table) {
            $table->id();
            $table->string('miasto');
            $table->string('ulica');
            $table->string('nr_domu');
            $table->string('kod_pocztowy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adresy');
    }
};
