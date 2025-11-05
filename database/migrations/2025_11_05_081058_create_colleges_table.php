<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('colleges', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

        $data = [
            ['id' => 1, 'name' => 'Business Entrepreneurship and Accountancy'],
            ['id' => 2, 'name' => 'Criminal Justice Education'],
            ['id' => 3, 'name' => 'Fisheries and Aquatic Sciences'],
            ['id' => 4, 'name' => 'Hospitality Management'],
            ['id' => 5, 'name' => 'Industrial Technology'],
            ['id' => 6, 'name' => 'Information and Computing Sciences'],
            ['id' => 7, 'name' => 'Teacher Education'],
            ['id' => 8, 'name' => 'Graduate School'],
        ];

        DB::table('colleges')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colleges');
    }
};
