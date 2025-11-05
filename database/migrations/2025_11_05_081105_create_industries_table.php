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
        Schema::create('industries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

        $data = [
            ['id' => 1, 'name' => 'Accounting'],
            ['id' => 2, 'name' => 'Administration & Office Support'],
            ['id' => 3, 'name' => 'Advertising, Arts & Media'],
            ['id' => 4, 'name' => 'Banking & Financial Services'],
            ['id' => 5, 'name' => 'Call Centre & Customer Service'],
            ['id' => 6, 'name' => 'CEO & General Management'],
            ['id' => 7, 'name' => 'Community Services & Development'],
            ['id' => 8, 'name' => 'Construction'],
            ['id' => 9, 'name' => 'Consulting & Strategy'],
            ['id' => 10, 'name' => 'Design & Architecture'],
            ['id' => 11, 'name' => 'Education & Training'],
            ['id' => 12, 'name' => 'Engineering'],
            ['id' => 13, 'name' => 'Farming, Animals & Conservation'],
            ['id' => 14, 'name' => 'Government & Defense'],
            ['id' => 15, 'name' => 'Healthcare & Medical'],
            ['id' => 16, 'name' => 'Hospitality & Tourism'],
            ['id' => 17, 'name' => 'Human Resources & Recruitment'],
            ['id' => 18, 'name' => 'Information & Communication Technology'],
            ['id' => 19, 'name' => 'Insurance & Superannuation'],
            ['id' => 20, 'name' => 'Legal'],
            ['id' => 21, 'name' => 'Manufacturing, Transport & Logistics'],
            ['id' => 22, 'name' => 'Marketing & Communications'],
            ['id' => 23, 'name' => 'Mining, Resources & Energy'],
            ['id' => 24, 'name' => 'Real Estate & Property'],
            ['id' => 25, 'name' => 'Retail & Consumer Products'],
            ['id' => 26, 'name' => 'Sales'],
            ['id' => 27, 'name' => 'Science & Technology'],
            ['id' => 28, 'name' => 'Self Employment'],
            ['id' => 29, 'name' => 'Sport & Recreation'],
            ['id' => 30, 'name' => 'Trades & Services'],
        ];

        DB::table('industries')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('industries');
    }
};
