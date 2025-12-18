<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Table Users
        // Schema::create('users', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('email')->unique();
        //     $table->string('password_hash'); // Sesuai request, biasanya Laravel menggunakan 'password'
        //     $table->enum('role', ['admin', 'alumni', 'mahasiswa', 'dosen']);
            
        //     // created_at default now(), last_login nullable
        //     $table->timestamp('created_at')->useCurrent();
        //     $table->timestamp('last_login')->nullable();
            
        //     // Opsional: updated_at untuk Eloquent
        //     $table->timestamp('updated_at')->nullable();
        // });

        // 2. Table Profiles (One-to-One dengan Users)
        Schema::create('profiles', function (Blueprint $table) {
            // PK sekaligus FK ke users.id
            $table->foreignId('user_id')->primary()->constrained('users')->onDelete('cascade');
            
            $table->string('full_name');
            $table->string('phone_number')->nullable();
            $table->string('profile_picture_url')->nullable();
            $table->text('bio')->nullable()->comment('Deskripsi diri singkat');
            $table->text('address')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        // 3. Table Study Programs
        Schema::create('study_programs', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable(); // Kode Prodi
            $table->string('name')->nullable();
            $table->string('faculty')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('study_programs');
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('users');
    }
};
