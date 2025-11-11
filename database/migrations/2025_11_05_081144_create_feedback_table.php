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
        Schema::create('feedback', function (Blueprint $table) {
            $table->foreignId('graduate_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->smallInteger('relevance');
            $table->smallInteger('skills');
            $table->smallInteger('competency');
            $table->string('post_graduate');
            $table->string('engagement');
            $table->string('entrepreneurship');
            $table->text('suggestions')->nullable();
            $table->date('date_submitted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
