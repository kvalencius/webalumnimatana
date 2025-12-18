<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('posted_by')->constrained('users')->cascadeOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();

            $table->string('judul');
            $table->string('perusahaan');
            $table->string('tipe_pekerjaan');
            $table->string('lokasi');
            $table->text('deskripsi');
            $table->text('persyaratan')->nullable();
            
            $table->decimal('gaji_min', 15, 2)->nullable();
            $table->decimal('gaji_max', 15, 2)->nullable();
            
            $table->string('kontak_email')->nullable();
            $table->string('kontak_phone')->nullable();

            $table->string('status')->default('approved');
            $table->text('rejection_note')->nullable();

            $table->timestamps(); // ⬅️ INI WAJIB kalau kamu pakai Eloquent biasa
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_vacancies');
    }
};
