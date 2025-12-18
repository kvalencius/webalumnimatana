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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('content')->nullable()->comment('Konten teks dari post');
            $table->string('image')->nullable()->comment('Path gambar jika ada');
            $table->string('video')->nullable()->comment('Path atau URL video jika ada');
            $table->integer('likes_count')->default(0)->comment('Jumlah likes');
            $table->integer('comments_count')->default(0)->comment('Jumlah comments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
