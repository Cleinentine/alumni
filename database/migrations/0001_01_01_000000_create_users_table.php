<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('contact_number')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->smallInteger('roles');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        /*
            Roles
                1 = Super Admin
                2 = Organization Admin
                3 = Site Admin
                4 = User
        */

        $data = [
            [
                'id' => 1,
                'email' => 'csuan.superadmin@gmail.com',
                'password' => Hash::make('superadmin'),
                'roles' => 1,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],

            [
                'id' => 2,
                'email' => 'csuan.orgadmin@gmail.com',
                'password' => Hash::make('orgadmin'),
                'roles' => 2,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],

            [
                'id' => 3,
                'email' => 'csuan.siteadmin@gmail.com',
                'password' => Hash::make('siteadmin'),
                'roles' => 3,
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
        ];

        DB::table('users')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
