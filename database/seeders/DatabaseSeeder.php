<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\Review;
use App\Models\Booking;
use App\Models\Wishlist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key checks to avoid constraint issues
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->command->info('🏗️  Starting NextBNB Database Seeding...');

        // Clear existing data
        $this->command->info('🗑️  Clearing existing data...');
        Wishlist::truncate();
        Review::truncate();
        Booking::truncate();
        PropertyImage::truncate();
        Property::truncate();
        User::where('email', '!=', 'admin@nextbnb.com')->delete();

        // 1. Create Categories (if not already exists from CategorySeeder)
        $this->command->info('📂 Ensuring categories exist...');
        if (Category::count() === 0) {
            $this->call(CategorySeeder::class);
        }

        // 2. Create Users
        $this->command->info('👥 Creating users...');
        
        // Create admin user
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@nextbnb.com'],
            [
                'name' => 'NextBNB Admin',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'phone' => '+1-555-0100',
                'date_of_birth' => '1985-05-15',
                'bio' => 'Welcome to NextBNB! I\'m here to help you have the best experience.',
                'is_host' => true,
                'is_verified' => true,
            ]
        );

        // Create demo users
        $demoUsers = [
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah@demo.com',
                'is_host' => true,
                'bio' => 'Experienced host with a passion for hospitality. I love meeting new people!',
            ],
            [
                'name' => 'Mike Chen',
                'email' => 'mike@demo.com',
                'is_host' => true,
                'bio' => 'Architecture enthusiast sharing my beautiful properties with fellow travelers.',
            ],
            [
                'name' => 'Emma Wilson',
                'email' => 'emma@demo.com',
                'is_host' => false,
                'bio' => 'Digital nomad exploring the world one city at a time.',
            ],
        ];

        foreach ($demoUsers as $userData) {
            User::firstOrCreate(
                ['email' => $userData['email']],
                array_merge([
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                    'phone' => fake()->phoneNumber(),
                    'date_of_birth' => fake()->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d'),
                    'is_verified' => true,
                ], $userData)
            );
        }

        // Create additional random users
        $regularUsers = User::factory(25)->create();
        $hostUsers = User::factory(15)->create(['is_host' => true]);

        $allUsers = User::all();
        $this->command->info("✅ Created {$allUsers->count()} users");

        // 3. Create Properties
        $this->command->info('🏠 Creating properties...');
        
        // Create featured luxury properties
        $featuredProperties = Property::factory(8)
            ->luxury()
            ->featured()
            ->create([
                'user_id' => $allUsers->where('is_host', true)->random()->id,
                'category_id' => Category::inRandomOrder()->first()->id,
            ]);

        // Create regular properties
        $regularProperties = Property::factory(35)->create([
            'user_id' => $allUsers->where('is_host', true)->random()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
        ]);

        // Create budget properties
        $budgetProperties = Property::factory(12)
            ->budget()
            ->create([
                'user_id' => $allUsers->where('is_host', true)->random()->id,
                'category_id' => Category::inRandomOrder()->first()->id,
            ]);

        $allProperties = Property::all();
        $this->command->info("✅ Created {$allProperties->count()} properties");

        // 4. Create Property Images
        $this->command->info('📸 Creating property images...');
        
        foreach ($allProperties as $property) {
            // Create 3-8 images per property
            $imageCount = fake()->numberBetween(3, 8);
            
            // First image is primary
            PropertyImage::factory()->primary()->create([
                'property_id' => $property->id,
            ]);
            
            // Additional images
            PropertyImage::factory($imageCount - 1)->create([
                'property_id' => $property->id,
                'sort_order' => fake()->numberBetween(2, 10),
            ]);
        }

        $totalImages = PropertyImage::count();
        $this->command->info("✅ Created {$totalImages} property images");

        // 5. Create Bookings
        $this->command->info('📅 Creating bookings...');
        
        // Create completed bookings (past)
        Booking::factory(80)->completed()->create([
            'user_id' => $allUsers->random()->id,
            'property_id' => $allProperties->random()->id,
        ]);

        // Create upcoming bookings
        Booking::factory(25)->upcoming()->create([
            'user_id' => $allUsers->random()->id,
            'property_id' => $allProperties->random()->id,
        ]);

        // Create some active bookings
        Booking::factory(5)->active()->create([
            'user_id' => $allUsers->random()->id,
            'property_id' => $allProperties->random()->id,
        ]);

        // Create some cancelled bookings
        Booking::factory(15)->cancelled()->create([
            'user_id' => $allUsers->random()->id,
            'property_id' => $allProperties->random()->id,
        ]);

        $totalBookings = Booking::count();
        $this->command->info("✅ Created {$totalBookings} bookings");

        // 6. Create Reviews (only for completed bookings)
        $this->command->info('⭐ Creating reviews...');
        
        $completedBookings = Booking::where('status', 'completed')->get();
        
        // 70% of completed bookings get reviews
        $reviewableBookings = $completedBookings->random((int)($completedBookings->count() * 0.7));
        
        foreach ($reviewableBookings as $booking) {
            Review::factory()->positive()->create([
                'user_id' => $booking->user_id,
                'property_id' => $booking->property_id,
                'created_at' => fake()->dateTimeBetween($booking->check_out, 'now'),
            ]);
        }

        $totalReviews = Review::count();
        $this->command->info("✅ Created {$totalReviews} reviews");

        // 7. Create Wishlists
        $this->command->info('💝 Creating wishlists...');
        
        // Each user saves 2-8 random properties
        foreach ($allUsers as $user) {
            $wishlistCount = fake()->numberBetween(1, 6);
            $savedProperties = $allProperties->random($wishlistCount);
            
            foreach ($savedProperties as $property) {
                Wishlist::factory()->create([
                    'user_id' => $user->id,
                    'property_id' => $property->id,
                ]);
            }
        }

        $totalWishlists = Wishlist::count();
        $this->command->info("✅ Created {$totalWishlists} wishlist items");

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Summary
        $this->command->info('');
        $this->command->info('🎉 NextBNB Database Seeding Completed!');
        $this->command->info('📊 Summary:');
        $this->command->info("   👥 Users: {$allUsers->count()}");
        $this->command->info("   🏠 Properties: {$allProperties->count()}");
        $this->command->info("   📸 Images: {$totalImages}");
        $this->command->info("   📅 Bookings: {$totalBookings}");
        $this->command->info("   ⭐ Reviews: {$totalReviews}");
        $this->command->info("   💝 Wishlists: {$totalWishlists}");
        $this->command->info('');
        $this->command->info('🔑 Demo Accounts:');
        $this->command->info('   Admin: admin@nextbnb.com');
        $this->command->info('   Host: sarah@demo.com');
        $this->command->info('   Host: mike@demo.com');
        $this->command->info('   Guest: emma@demo.com');
        $this->command->info('   Password: password');
    }
}
