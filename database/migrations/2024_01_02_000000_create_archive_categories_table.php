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
        Schema::create('archive_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Category name like Buku Tanah, Surat Ukur, etc');
            $table->string('code')->unique()->comment('Category code for identification');
            $table->text('description')->nullable()->comment('Category description');
            $table->json('required_fields')->comment('JSON array of required fields for this category');
            $table->boolean('is_active')->default(true)->comment('Category status');
            $table->timestamps();
            
            $table->index('name');
            $table->index('code');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archive_categories');
    }
};