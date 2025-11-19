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
        Schema::create('graduates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->foreignId('program_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->foreignId('country_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->foreignId('state_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->foreignId('city_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('birth_date');
            $table->string('gender');
            $table->year('year_graduated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduates');
    }
};
