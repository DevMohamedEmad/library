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

        Schema::create('author_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->references('id')->on('users')->constrained()->onUpdate('cascade');
            $table->foreignId('category_id')->references('id')->on('users')->constrained()->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author_categories');
    }
};
