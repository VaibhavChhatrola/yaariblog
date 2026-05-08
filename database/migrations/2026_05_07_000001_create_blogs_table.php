<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Creates the blogs table with all required columns for the JobYaari Blogs system.
     */
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); // SEO-friendly URL identifier, auto-generated from title
            $table->string('image')->nullable(); // Stored path in storage/app/public/blogs/
            $table->text('short_description'); // Preview text shown on listing cards
            $table->longText('content'); // Full HTML/text content of the blog post
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
