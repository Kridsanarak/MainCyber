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
            $table->string('topic', 100);
            $table->text('details')->nullable();
            $table->string('post_pic', 45)->nullable();
            $table->unsignedInteger('users_id');
            $table->index('users_id')
                  ->references('id')->on('users')
                  ->onDelete('NO ACTION')
                  ->onUpdate('NO ACTION');
            $table->string('users_name', 45);
            $table->index('users_name')
                  ->references('name')->on('users')
                  ->onDelete('NO ACTION')
                  ->onUpdate('NO ACTION');
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
