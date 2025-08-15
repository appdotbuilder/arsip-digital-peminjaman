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
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->string('borrowing_number')->unique()->comment('Unique borrowing identification number');
            $table->foreignId('borrower_id')->constrained('users')->onDelete('cascade');
            $table->string('borrower_name')->comment('Name of the person borrowing');
            $table->string('borrower_photo')->nullable()->comment('Photo path of borrower');
            $table->foreignId('district_id')->constrained()->onDelete('cascade');
            $table->foreignId('village_id')->constrained()->onDelete('cascade');
            $table->date('borrow_date')->comment('Date when archives were borrowed');
            $table->date('return_date')->comment('Expected return date');
            $table->date('actual_return_date')->nullable()->comment('Actual return date');
            $table->enum('status', ['pending', 'approved', 'borrowed', 'partially_returned', 'returned', 'overdue'])->default('pending');
            $table->text('notes')->nullable()->comment('Additional notes');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            
            $table->index('borrowing_number');
            $table->index('status');
            $table->index('borrow_date');
            $table->index('return_date');
            $table->index(['borrower_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};