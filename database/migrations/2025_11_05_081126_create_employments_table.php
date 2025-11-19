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
        Schema::create('employments', function (Blueprint $table) {
            $table->foreignId('graduate_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('industry_id')
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
            $table->string('status')->nullable();
            $table->string('title')->nullable();
            $table->string('company')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->smallInteger('time_to_first_job')->nullable();
            $table->string('search_methods')->nullable();
            $table->text('unemployment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employments');
    }
};
