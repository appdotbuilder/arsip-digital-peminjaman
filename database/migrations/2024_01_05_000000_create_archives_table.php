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
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('archive_category_id')->constrained()->onDelete('cascade');
            $table->string('title')->comment('Archive title or name');
            $table->string('archive_number')->comment('Archive identification number');
            $table->json('archive_data')->comment('JSON data specific to category (HAK type, SU number, etc)');
            $table->text('description')->nullable()->comment('Archive description');
            $table->enum('status', ['available', 'borrowed'])->default('available')->comment('Archive availability status');
            $table->timestamps();
            
            $table->index('title');
            $table->index('archive_number');
            $table->index('status');
            $table->index(['archive_category_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};