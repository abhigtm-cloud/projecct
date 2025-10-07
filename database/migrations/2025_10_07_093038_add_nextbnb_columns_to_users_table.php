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
            $table->string('phone')->nullable()->after('password');
            $table->date('date_of_birth')->nullable()->after('phone');
            $table->text('bio')->nullable()->after('date_of_birth');
            $table->string('profile_photo')->nullable()->after('bio');
            $table->boolean('is_host')->default(false)->after('profile_photo');
            $table->boolean('is_verified')->default(false)->after('is_host');
            $table->timestamp('host_since')->nullable()->after('is_verified');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'date_of_birth', 
                'bio',
                'profile_photo',
                'is_host',
                'is_verified',
                'host_since'
            ]);
        });
    }
};
