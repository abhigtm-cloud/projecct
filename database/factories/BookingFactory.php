<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $checkIn = fake()->dateTimeBetween('-1 year', '+6 months');
        $nights = fake()->numberBetween(1, 14); // 1-14 night stays
        $checkOut = Carbon::parse($checkIn)->addDays($nights);
        
        // Determine booking status based on dates
        $now = now();
        $checkInDate = Carbon::parse($checkIn);
        $checkOutDate = Carbon::parse($checkOut);
        
        if ($checkOutDate < $now) {
            // Past booking - mostly completed, some cancelled
            $status = fake()->randomElement(['completed', 'completed', 'completed', 'cancelled']);
        } elseif ($checkInDate <= $now && $checkOutDate >= $now) {
            // Current booking - should be confirmed (ongoing)
            $status = 'confirmed';
        } else {
            // Future booking - mostly confirmed, some pending
            $status = fake()->randomElement(['confirmed', 'confirmed', 'confirmed', 'pending']);
        }

        $guests = fake()->numberBetween(1, 6);
        $pricePerNight = fake()->numberBetween(50, 400);
        $totalNights = $nights;
        $subtotal = $pricePerNight * $totalNights;
        $cleaningFee = fake()->optional(0.8)->numberBetween(20, 100) ?? 0;
        $serviceFee = fake()->optional(0.9)->numberBetween(15, 80) ?? 0;
        $taxes = $subtotal * 0.12; // 12% tax rate
        $totalAmount = $subtotal + $cleaningFee + $serviceFee + $taxes;

        // Fix created_at to ensure it's before check_in
        $createdAt = fake()->dateTimeBetween('-1 year', '-1 day');
        if ($createdAt > $checkInDate->subDays(1)) {
            $createdAt = $checkInDate->subDays(fake()->numberBetween(1, 30));
        }

        return [
            'user_id' => User::factory(),
            'property_id' => Property::factory(),
            'check_in' => $checkInDate->format('Y-m-d'),
            'check_out' => $checkOutDate->format('Y-m-d'),
            'guests' => $guests,
            'nights' => $totalNights,
            'price_per_night' => $pricePerNight,
            'subtotal' => $subtotal,
            'cleaning_fee' => $cleaningFee,
            'service_fee' => $serviceFee,
            'taxes' => round($taxes, 2),
            'total_amount' => round($totalAmount, 2),
            'status' => $status,
            'guest_details' => json_encode([
                'name' => fake()->name(),
                'phone' => fake()->phoneNumber(),
                'email' => fake()->safeEmail(),
            ]),
            'special_requests' => fake()->optional(0.3)->sentence(),
            'payment_status' => $status === 'completed' ? 'paid' : ($status === 'cancelled' ? 'refunded' : 'pending'),
            'payment_method' => fake()->randomElement(['credit_card', 'debit_card', 'paypal', 'bank_transfer']),
            'transaction_id' => 'TXN' . fake()->randomNumber(8),
            'created_at' => $createdAt,
            'updated_at' => fake()->dateTimeBetween($createdAt, 'now'),
        ];
    }

    /**
     * Generate a unique booking reference.
     */
    private function generateBookingReference(): string
    {
        return 'NXT' . fake()->randomNumber(8);
    }

    /**
     * Create a confirmed booking.
     */
    public function confirmed(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'confirmed',
                'payment_status' => 'paid',
            ];
        });
    }

    /**
     * Create a completed booking.
     */
    public function completed(): Factory
    {
        return $this->state(function (array $attributes) {
            $checkOut = fake()->dateTimeBetween('-1 year', '-1 day');
            $nights = fake()->numberBetween(2, 10);
            $checkIn = Carbon::parse($checkOut)->subDays($nights);
            
            return [
                'status' => 'completed',
                'check_in' => $checkIn->format('Y-m-d'),
                'check_out' => $checkOut->format('Y-m-d'),
                'nights' => $nights,
                'payment_status' => 'paid',
            ];
        });
    }

    /**
     * Create a cancelled booking.
     */
    public function cancelled(): Factory
    {
        return $this->state(function (array $attributes) {
            $checkIn = fake()->dateTimeBetween('-6 months', '+3 months');
            
            return [
                'status' => 'cancelled',
                'check_in' => $checkIn,
                'payment_status' => 'refunded',
            ];
        });
    }

    /**
     * Create an active booking (currently ongoing).
     */
    public function active(): Factory
    {
        return $this->state(function (array $attributes) {
            $checkIn = fake()->dateTimeBetween('-7 days', 'now');
            $checkOut = fake()->dateTimeBetween('now', '+7 days');
            $nights = Carbon::parse($checkIn)->diffInDays(Carbon::parse($checkOut));
            
            return [
                'status' => 'confirmed', // Use confirmed instead of active
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'nights' => $nights,
                'payment_status' => 'paid',
            ];
        });
    }

    /**
     * Create a future booking.
     */
    public function upcoming(): Factory
    {
        return $this->state(function (array $attributes) {
            $checkIn = fake()->dateTimeBetween('+1 day', '+6 months');
            $nights = fake()->numberBetween(2, 14);
            $checkOut = Carbon::parse($checkIn)->addDays($nights);
            
            return [
                'status' => 'confirmed',
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'nights' => $nights,
                'payment_status' => 'paid',
            ];
        });
    }
}