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
        Schema::create('dokumentacje_medyczne', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wizyta_id')->unique()->constrained('wizyty')->onDelete('cascade');
            $table->text('diagnoza');
            $table->text('zalecenia');
            $table->decimal('temperatura', 4, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumentacje_medyczne');
    }
};
