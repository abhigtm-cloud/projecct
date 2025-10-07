<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cities = [
            ['New York', 'United States', 40.7128, -74.0060],
            ['Los Angeles', 'United States', 34.0522, -118.2437],
            ['London', 'United Kingdom', 51.5074, -0.1278],
            ['Paris', 'France', 48.8566, 2.3522],
            ['Tokyo', 'Japan', 35.6762, 139.6503],
            ['Barcelona', 'Spain', 41.3851, 2.1734],
            ['Rome', 'Italy', 41.9028, 12.4964],
            ['Amsterdam', 'Netherlands', 52.3676, 4.9041],
            ['Berlin', 'Germany', 52.5200, 13.4050],
            ['Sydney', 'Australia', -33.8688, 151.2093],
            ['Miami', 'United States', 25.7617, -80.1918],
            ['San Francisco', 'United States', 37.7749, -122.4194],
            ['Chicago', 'United States', 41.8781, -87.6298],
            ['Toronto', 'Canada', 43.6532, -79.3832],
            ['Vancouver', 'Canada', 49.2827, -123.1207],
        ];

        $cityData = fake()->randomElement($cities);
        $bedrooms = fake()->numberBetween(1, 6);
        $bathrooms = fake()->numberBetween(1, $bedrooms + 1);
        $beds = fake()->numberBetween($bedrooms, $bedrooms + 2);
        $guests = fake()->numberBetween($beds, $beds + 2);

        $propertyTypes = [
            'entire_place' => [
                'Stunning ' . fake()->randomElement(['Modern', 'Luxury', 'Cozy', 'Spacious', 'Charming', 'Beautiful']),
                'Amazing ' . fake()->randomElement(['Apartment', 'House', 'Villa', 'Condo', 'Loft', 'Penthouse']),
                'Perfect ' . fake()->randomElement(['Getaway', 'Retreat', 'Escape', 'Haven', 'Sanctuary']),
            ],
            'private_room' => [
                'Comfortable ' . fake()->randomElement(['Private', 'Cozy', 'Bright', 'Spacious', 'Quiet']),
                'Beautiful ' . fake()->randomElement(['Room', 'Bedroom', 'Space', 'Suite']),
            ],
            'shared_room' => [
                'Friendly ' . fake()->randomElement(['Shared', 'Social', 'Budget', 'Backpacker']),
                'Great ' . fake()->randomElement(['Room', 'Space', 'Accommodation']),
            ]
        ];

        $type = fake()->randomElement(['entire_place', 'private_room', 'shared_room']);
        $titleParts = $propertyTypes[$type];
        $title = fake()->randomElement($titleParts) . ' in ' . $cityData[0];

        $amenities = [];
        $availableAmenities = [
            'wifi', 'tv', 'kitchen', 'washer', 'dryer', 'air_conditioning', 'heating',
            'workspace', 'pool', 'hot_tub', 'patio', 'bbq_grill', 'fire_pit',
            'pool_table', 'gym', 'beach_access', 'parking', 'ev_charger',
            'smoke_alarm', 'carbon_monoxide', 'first_aid', 'fire_extinguisher',
            'self_check_in', 'pets_allowed'
        ];

        // Add basic amenities (high probability)
        $basicAmenities = ['wifi', 'tv', 'smoke_alarm', 'carbon_monoxide'];
        foreach ($basicAmenities as $amenity) {
            if (fake()->boolean(90)) {
                $amenities[] = $amenity;
            }
        }

        // Add random additional amenities
        $otherAmenities = array_diff($availableAmenities, $basicAmenities);
        foreach ($otherAmenities as $amenity) {
            if (fake()->boolean(30)) {
                $amenities[] = $amenity;
            }
        }

        // Type-specific amenities
        if ($type === 'entire_place') {
            if (fake()->boolean(80)) $amenities[] = 'kitchen';
            if (fake()->boolean(60)) $amenities[] = 'washer';
            if (fake()->boolean(70)) $amenities[] = 'self_check_in';
        }

        $pricePerNight = fake()->numberBetween(25, 500);
        $cleaningFee = fake()->boolean(80) ? fake()->numberBetween(15, 100) : 0;
        $serviceFee = fake()->boolean(70) ? fake()->numberBetween(10, 50) : 0;

        return [
            'title' => $title,
            'description' => $this->generateDescription($cityData[0], $type, $guests),
            'type' => $type,
            'country' => $cityData[1],
            'city' => $cityData[0],
            'address' => fake()->streetAddress(),
            'latitude' => $cityData[2] + fake()->randomFloat(4, -0.1, 0.1),
            'longitude' => $cityData[3] + fake()->randomFloat(4, -0.1, 0.1),
            'price_per_night' => $pricePerNight,
            'cleaning_fee' => $cleaningFee,
            'service_fee' => $serviceFee,
            'guests' => $guests,
            'bedrooms' => $bedrooms,
            'beds' => $beds,
            'bathrooms' => $bathrooms,
            'amenities' => json_encode(array_unique($amenities)),
            'house_rules' => $this->generateHouseRules(),
            'instant_book' => fake()->boolean(60), // 60% allow instant booking
            'is_active' => fake()->boolean(95), // 95% active listings
            'is_featured' => fake()->boolean(15), // 15% featured listings
            'user_id' => User::factory(),
            'category_id' => Category::inRandomOrder()->first()?->id ?? 1,
            'created_at' => fake()->dateTimeBetween('-2 years', 'now'),
            'updated_at' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }

    /**
     * Generate a realistic property description.
     */
    private function generateDescription(string $city, string $type, int $guests): string
    {
        $descriptions = [
            'entire_place' => [
                "Welcome to our beautiful {type} in the heart of {city}! Perfect for {guests} guests, this space offers everything you need for a comfortable stay.",
                "Discover this amazing {type} located in a prime area of {city}. Ideal for {guests} guests looking for a memorable experience.",
                "Experience the best of {city} in this stunning {type}. Accommodates {guests} guests with all modern amenities.",
            ],
            'private_room' => [
                "Enjoy a comfortable private room in our lovely home in {city}. Perfect for {guests} guests seeking an authentic local experience.",
                "Stay in this cozy private room with great access to everything {city} has to offer. Ideal for {guests} guests.",
            ],
            'shared_room' => [
                "Budget-friendly accommodation in {city}! Share this friendly space with other travelers. Great for {guests} guests.",
                "Meet fellow travelers in this social shared room in {city}. Perfect for {guests} guests on a budget.",
            ]
        ];

        $template = fake()->randomElement($descriptions[$type]);
        $description = str_replace(['{type}', '{city}', '{guests}'], [
            str_replace('_', ' ', $type),
            $city,
            $guests
        ], $template);

        // Add additional details
        $additionalDetails = [
            " The space is recently renovated and features modern furnishings.",
            " You'll love the natural light and comfortable atmosphere.",
            " Great location with easy access to public transportation.",
            " Walking distance to restaurants, shops, and attractions.",
            " Free WiFi and all essential amenities included.",
            " Perfect for both business and leisure travelers.",
        ];

        $description .= fake()->randomElement($additionalDetails);
        $description .= " " . fake()->randomElement($additionalDetails);

        return $description;
    }

    /**
     * Generate realistic house rules.
     */
    private function generateHouseRules(): ?string
    {
        $rules = [];
        $possibleRules = [
            "No smoking inside the property",
            "No parties or events",
            "Quiet hours: 10 PM - 8 AM",
            "No pets allowed",
            "Check-in after 3 PM, check-out before 11 AM",
            "Maximum occupancy as listed",
            "Please remove shoes when entering",
            "No eating in bedrooms",
            "Keep common areas clean and tidy",
        ];

        $numRules = fake()->numberBetween(3, 6);
        $selectedRules = fake()->randomElements($possibleRules, $numRules);

        return implode("\n", $selectedRules);
    }

    /**
     * Create a featured property.
     */
    public function featured(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_featured' => true,
                'price_per_night' => fake()->numberBetween(100, 800), // Higher prices for featured
            ];
        });
    }

    /**
     * Create a budget property.
     */
    public function budget(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'price_per_night' => fake()->numberBetween(25, 80),
                'type' => fake()->randomElement(['private_room', 'shared_room']),
                'cleaning_fee' => fake()->boolean(50) ? fake()->numberBetween(10, 30) : 0,
            ];
        });
    }

    /**
     * Create a luxury property.
     */
    public function luxury(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'price_per_night' => fake()->numberBetween(200, 1000),
                'type' => 'entire_place',
                'bedrooms' => fake()->numberBetween(3, 8),
                'bathrooms' => fake()->numberBetween(3, 6),
                'is_featured' => true,
                'amenities' => json_encode([
                    'wifi', 'tv', 'kitchen', 'washer', 'dryer', 'air_conditioning', 
                    'heating', 'workspace', 'pool', 'hot_tub', 'patio', 'bbq_grill', 
                    'parking', 'smoke_alarm', 'carbon_monoxide', 'self_check_in'
                ]),
            ];
        });
    }
}