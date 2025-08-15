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
        Schema::create('borrowing_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrowing_id')->constrained()->onDelete('cascade');
            $table->foreignId('archive_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['borrowed', 'returned'])->default('borrowed');
            $table->timestamp('returned_at')->nullable()->comment('When this specific item was returned');
            $table->timestamps();
            
            $table->index('status');
            $table->index(['borrowing_id', 'status']);
            $table->unique(['borrowing_id', 'archive_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowing_items');
    }
};