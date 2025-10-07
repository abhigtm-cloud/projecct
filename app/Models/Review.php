<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',
        'user_id',
        'booking_id',
        'rating',
        'cleanliness',
        'communication',
        'check_in',
        'accuracy',
        'location',
        'value',
        'comment',
        'private_feedback',
        'is_approved',
        'is_featured'
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_featured' => 'boolean'
    ];

    // Relationships
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Helper methods
    public function getAverageRatingAttribute()
    {
        $ratings = collect([
            $this->cleanliness,
            $this->communication,
            $this->check_in,
            $this->accuracy,
            $this->location,
            $this->value
        ])->filter();

        return $ratings->isEmpty() ? $this->rating : round($ratings->avg(), 1);
    }

    public function getStarRatingAttribute()
    {
        return str_repeat('★', $this->rating) . str_repeat('☆', 5 - $this->rating);
    }

    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('F Y');
    }
}
