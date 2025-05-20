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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('partner_name');
            $table->bigInteger('national_id');
            $table->bigInteger('partner_national_id');
            $table->date('birth_date');
            $table->date('partner_birth_date');
            $table->enum('payment_status', ['reject', 'qualify']);
            $table->enum('status', ['booked', 'ordered','dp']);
            $table->enum('approval_status', ['approved', 'pending', 'rejected'])->default('pending');
            $table->enum('solution',['Takeover Bank', 'Clearing Payment','Change Credit Name','Repayment'])->nullable();
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
