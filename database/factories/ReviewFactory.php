<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rating = fake()->numberBetween(3, 5); // Most reviews are positive (3-5 stars)
        
        return [
            'user_id' => User::factory(),
            'property_id' => Property::factory(),
            'rating' => $rating,
            'comment' => $this->generateReviewComment($rating),
            'cleanliness' => fake()->numberBetween(max(1, $rating - 1), min(5, $rating + 1)),
            'accuracy' => fake()->numberBetween(max(1, $rating - 1), min(5, $rating + 1)),
            'check_in' => fake()->numberBetween(max(1, $rating - 1), min(5, $rating + 1)),
            'communication' => fake()->numberBetween(max(1, $rating - 1), min(5, $rating + 1)),
            'location' => fake()->numberBetween(max(1, $rating - 1), min(5, $rating + 1)),
            'value' => fake()->numberBetween(max(1, $rating - 1), min(5, $rating + 1)),
            'created_at' => fake()->dateTimeBetween('-2 years', 'now'),
            'updated_at' => fake()->dateTimeBetween('-2 years', 'now'),
        ];
    }

    /**
     * Generate realistic review comments based on rating.
     */
    private function generateReviewComment(int $rating): string
    {
        $positiveComments = [
            "Amazing stay! The place was exactly as described and the host was very responsive.",
            "Perfect location and beautifully decorated space. Would definitely stay here again!",
            "Outstanding experience! Clean, comfortable, and great communication from the host.",
            "Lovely property with all the amenities we needed. Highly recommended!",
            "Fantastic place! Great location, spotlessly clean, and the host was wonderful.",
            "Exceeded our expectations in every way. Beautiful space and perfect for our needs.",
            "Incredible stay! The photos don't do it justice - even better in person.",
            "Perfect getaway! Everything was clean, comfortable, and well-maintained.",
            "Amazing host and beautiful property. Couldn't have asked for a better experience!",
            "Wonderful stay! Great location, clean space, and excellent communication.",
        ];

        $goodComments = [
            "Great place to stay! Just as described and host was helpful.",
            "Nice property in a good location. Would recommend to others.",
            "Comfortable stay with good amenities. Host was responsive.",
            "Solid choice for the area. Clean and well-equipped.",
            "Good value for money. Property was clean and comfortable.",
            "Pleasant stay overall. Good location and nice space.",
            "Enjoyed our time here. Property was as expected and host was friendly.",
            "Nice place with good amenities. Would consider staying again.",
            "Comfortable accommodation in a convenient location.",
            "Good experience overall. Clean property and responsive host.",
        ];

        $averageComments = [
            "Decent place to stay. Met our basic needs but nothing exceptional.",
            "Okay accommodation. Some minor issues but generally acceptable.",
            "Average stay. Property was fine but could use some updates.",
            "Not bad overall. A few small issues but generally okay.",
            "Adequate for our needs. Some things could be improved.",
            "Fair accommodation. Good location but room for improvement.",
            "Reasonable place to stay. Had what we needed.",
            "Acceptable property. Nothing special but served its purpose.",
        ];

        switch ($rating) {
            case 5:
                $comments = $positiveComments;
                break;
            case 4:
                $comments = array_merge($positiveComments, $goodComments);
                break;
            case 3:
                $comments = array_merge($goodComments, $averageComments);
                break;
            default:
                $comments = $averageComments;
        }

        $baseComment = fake()->randomElement($comments);
        
        // Add occasional additional details
        if (fake()->boolean(30)) {
            $additionalDetails = [
                " The check-in process was smooth and easy.",
                " Great restaurants and shops nearby.",
                " Very quiet neighborhood - perfect for relaxation.",
                " Easy access to public transportation.",
                " Host provided excellent local recommendations.",
                " Kitchen was well-stocked with everything we needed.",
                " Beds were very comfortable.",
                " Great WiFi for remote work.",
            ];
            $baseComment .= fake()->randomElement($additionalDetails);
        }

        return $baseComment;
    }

    /**
     * Create a high-rated review (4-5 stars).
     */
    public function positive(): Factory
    {
        return $this->state(function (array $attributes) {
            $rating = fake()->numberBetween(4, 5);
            return [
                'rating' => $rating,
                'comment' => $this->generateReviewComment($rating),
                'cleanliness' => fake()->numberBetween($rating, 5),
                'accuracy' => fake()->numberBetween($rating, 5),
                'check_in' => fake()->numberBetween($rating, 5),
                'communication' => fake()->numberBetween($rating, 5),
                'location' => fake()->numberBetween($rating, 5),
                'value' => fake()->numberBetween($rating, 5),
            ];
        });
    }

    /**
     * Create a recent review.
     */
    public function recent(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'created_at' => fake()->dateTimeBetween('-1 month', 'now'),
                'updated_at' => fake()->dateTimeBetween('-1 month', 'now'),
            ];
        });
    }
}