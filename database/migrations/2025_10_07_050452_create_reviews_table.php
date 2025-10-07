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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Reviewer
            $table->foreignId('booking_id')->nullable()->constrained()->onDelete('set null');
            
            // Rating (1-5 stars)
            $table->integer('rating'); // Overall rating
            $table->integer('cleanliness')->nullable();
            $table->integer('communication')->nullable();
            $table->integer('check_in')->nullable();
            $table->integer('accuracy')->nullable();
            $table->integer('location')->nullable();
            $table->integer('value')->nullable();
            
            // Review Content
            $table->text('comment');
            $table->text('private_feedback')->nullable(); // Only visible to host
            
            // Status
            $table->boolean('is_approved')->default(true);
            $table->boolean('is_featured')->default(false);
            
            $table->timestamps();
            
            // Indexes
            $table->index(['property_id', 'is_approved']);
            $table->index(['user_id', 'created_at']);
            
            // Ensure one review per booking
            $table->unique(['user_id', 'booking_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
