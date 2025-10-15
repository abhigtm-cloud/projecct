<?php

namespace Database\Factories;

use App\Models\PropertyImage;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyImage>
 */
class PropertyImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PropertyImage::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Using Unsplash for realistic property images
        $imageCategories = [
            'architecture', 'house', 'apartment', 'bedroom', 'kitchen', 
            'living-room', 'bathroom', 'interior', 'home', 'room'
        ];

        $category = fake()->randomElement($imageCategories);
        $width = 800;
        $height = 600;
        
        // Generate placeholder URL for property images
        $imageUrl = "https://picsum.photos/{$width}/{$height}?random=" . fake()->numberBetween(1, 1000);
        
        return [
            'property_id' => Property::factory(),
            'image_path' => $imageUrl,
            'alt_text' => fake()->sentence(3),
            'is_primary' => false, // Will be set to true for one image per property in seeder
            'sort_order' => fake()->numberBetween(1, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create a primary image.
     */
    public function primary(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_primary' => true,
                'sort_order' => 1,
            ];
        });
    }
}