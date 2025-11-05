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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('position');
            $table->smallInteger('tier');
        });

        /*
            Tier 1 = CEO
            Tier 2 = 2nd Highest
            Tier 3 = College Alumni Coordinator
        */

        $data = [
            [
                'id' => 1,
                'name' => 'Ethaniel Pablo',
                'position' => 'Campus Executive Officer',
                'tier' => 1,
            ],

            [
                'id' => 2,
                'name' => 'Dylan Barrios',
                'position' => 'Alumni Coordinator',
                'tier' => 2,
            ],

            [
                'id' => 3,
                'name' => 'Aaliyah Salcedo',
                'position' => 'TVET Graduate Officer',
                'tier' => 2,
            ],

            [
                'id' => 4,
                'name' => 'Euan Cuizon',
                'position' => 'CBEA Alumni Coordinator',
                'tier' => 3,
            ],

            [
                'id' => 5,
                'name' => 'Beverly Dionisio',
                'position' => 'CCJE Coordinator',
                'tier' => 3,
            ],

            [
                'id' => 6,
                'name' => 'Joshua Abad',
                'position' => 'CFAS Alumni Coordinator',
                'tier' => 3,
            ],

            [
                'id' => 7,
                'name' => 'Jillian Ledesma',
                'position' => 'CHM Alumni Coordinator',
                'tier' => 3,
            ],

            [
                'id' => 8,
                'name' => 'Benny Zamora',
                'position' => 'CIT Alumni Coordinator',
                'tier' => 3,
            ],

            [
                'id' => 9,
                'name' => 'Katrice Trinidad',
                'position' => 'CICS Alumni Coordinator',
                'tier' => 3,
            ],

            [
                'id' => 10,
                'name' => 'John Michael Salazar',
                'position' => 'CTE Alumni Coordinator',
                'tier' => 3,
            ],
        ];

        DB::table('members')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
