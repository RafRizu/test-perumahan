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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('unit_group_id')->constrained('unit_groups')->onDelete('cascade');
            // Posisi untuk overlay (dalam pixel)
            $table->string('top')->nullable();
            $table->string('left')->nullable();
            $table->integer('width')->default(35); // default ukuran persegi
            $table->integer('height')->default(35);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
