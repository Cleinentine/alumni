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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('college_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('name')->unique();
        });

        /*
            1 = CBEA
            2 = CCJE
            3 = CFAS
            4 = CHM
            5 = CIT
            6 = CICS
            7 = CTE
            8 = Graduate
        */

        $data = [
            [
                'id' => 1,
                'college_id' => 1,
                'name' => 'Bachelor of Science in Accounting Information Science',
            ],

            [
                'id' => 2,
                'college_id' => 2,
                'name' => 'Bachelor of Science in Criminology',
            ],

            [
                'id' => 3,
                'college_id' => 3,
                'name' => 'Bachelor of Science in Fisheries',
            ],

            [
                'id' => 4,
                'college_id' => 4,
                'name' => 'Bachelor of Science in Hospitality Management',
            ],

            [
                'id' => 5,
                'college_id' => 5,
                'name' => 'Bachelor of Science in Industrial Technology Major in Automotive',
            ],

            [
                'id' => 6,
                'college_id' => 5,
                'name' => 'Bachelor of Science in Industrial Technology Major in Electrical',
            ],

            [
                'id' => 7,
                'college_id' => 5,
                'name' => 'Bachelor of Science in Industrial Technology Major in Electronics',
            ],

            [
                'id' => 8,
                'college_id' => 6,
                'name' => 'Bachelor of Science in Information Technology',
            ],

            [
                'id' => 9,
                'college_id' => 7,
                'name' => 'Bachelor of Science in Elementary Education',
            ],

            [
                'id' => 10,
                'college_id' => 7,
                'name' => 'Bachelor of Science in Secondary Education',
            ],

            [
                'id' => 11,
                'college_id' => 8,
                'name' => 'Doctor of Philosophy in Education Major in Educational Management',
            ],

            [
                'id' => 12,
                'college_id' => 8,
                'name' => 'Master of Arts in Education Major in English',
            ],

            [
                'id' => 13,
                'college_id' => 8,
                'name' => 'Master of Arts in Educational Management',
            ],

            [
                'id' => 14,
                'college_id' => 8,
                'name' => 'Master of Science in Information Technology',
            ],

            [
                'id' => 15,
                'college_id' => 8,
                'name' => 'Master of Science in Teaching Mathematics',
            ],
        ];

        DB::table('programs')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
