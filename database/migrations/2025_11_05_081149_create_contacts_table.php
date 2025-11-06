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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('contact_email');
            $table->string('contact_number');
            $table->string('alternate_contact_number');
        });

        $data = [
            'id' => 1,
            'contact_email' => 'csuaparri@csu.edu.ph',
            'contact_number' => '(078) 888-0786',
            'alternate_contact_number' => '(078) 888-0562',
        ];

        DB::table('contacts')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
