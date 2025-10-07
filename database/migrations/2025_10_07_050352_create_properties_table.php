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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Host/Owner
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            
            // Basic Information
            $table->string('title');
            $table->text('description');
            $table->string('type')->default('entire_place'); // entire_place, private_room, shared_room
            
            // Location
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            
            // Property Details
            $table->integer('guests')->default(1);
            $table->integer('bedrooms')->default(1);
            $table->integer('beds')->default(1);
            $table->integer('bathrooms')->default(1);
            
            // Pricing
            $table->decimal('price_per_night', 8, 2);
            $table->decimal('cleaning_fee', 8, 2)->default(0);
            $table->decimal('service_fee', 8, 2)->default(0);
            
            // Amenities (JSON)
            $table->json('amenities')->nullable();
            
            // House Rules
            $table->text('house_rules')->nullable();
            $table->boolean('instant_book')->default(false);
            
            // Status
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            
            // Ratings
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('review_count')->default(0);
            
            $table->timestamps();
            
            // Indexes
            $table->index(['city', 'is_active']);
            $table->index(['price_per_night', 'is_active']);
            $table->index(['rating', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
