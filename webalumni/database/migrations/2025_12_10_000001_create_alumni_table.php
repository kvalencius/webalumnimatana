<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nim');
            $table->string('graduation_year');
            $table->string('major');
            $table->string('current_job')->nullable();
            $table->string('company_name')->nullable();
            $table->string('job_position')->nullable();
            $table->string('salary_range')->nullable();
            $table->string('linkedin_profile')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};
