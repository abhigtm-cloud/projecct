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
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('name');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('phone')->nullable()->after('email');
            $table->date('date_of_birth')->nullable()->after('phone');
            $table->text('bio')->nullable()->after('date_of_birth');
            $table->string('profile_photo')->nullable()->after('bio');
            $table->string('government_id')->nullable()->after('profile_photo');
            $table->boolean('is_host')->default(false)->after('government_id');
            $table->boolean('is_verified')->default(false)->after('is_host');
            $table->json('languages')->nullable()->after('is_verified');
            $table->string('currency', 3)->default('USD')->after('languages');
            $table->timestamp('last_active_at')->nullable()->after('currency');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'last_name', 
                'phone',
                'date_of_birth',
                'bio',
                'profile_photo',
                'government_id',
                'is_host',
                'is_verified',
                'languages',
                'currency',
                'last_active_at'
            ]);
        });
    }
};
