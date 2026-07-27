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
        Schema::create('blogs_translate', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('create_user_id');
            $table->integer('update_user_id')->nullable();

            $table->string('title');
            $table->string('description')->nullable();
            $table->text('content')->nullable();
            $table->string('image_path')->nullable();

            $table->string('lang_code')->default('tr');

            $table->integer('blog_id');

            $table->index('id');
            $table->index('blog_id');
            $table->index('lang_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs_translate');
    }
};
