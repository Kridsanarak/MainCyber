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
        Schema::create('comment', function (Blueprint $table) {
            $table->id();
            $table->text('comment_text'); 
            $table->string('comment_pic', 255);
            $table->foreignId('posts_id')->constrained()->onDelete('cascade'); // เพิ่มคอลัมน์ posts_id และสร้าง foreign key
            $table->foreignId('users_id')->constrained()->onDelete('cascade'); // เพิ่มคอลัมน์ users_id และสร้าง foreign key
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment');
    }
};

