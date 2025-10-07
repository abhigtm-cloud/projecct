<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',
        'user_id',
        'check_in',
        'check_out',
        'guests',
        'nights',
        'price_per_night',
        'subtotal',
        'cleaning_fee',
        'service_fee',
        'taxes',
        'total_amount',
        'status',
        'guest_details',
        'special_requests',
        'payment_status',
        'payment_method',
        'transaction_id'
    ];

    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
        'price_per_night' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'cleaning_fee' => 'decimal:2',
        'service_fee' => 'decimal:2',
        'taxes' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'guest_details' => 'array'
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

    public function guest()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    // Scopes
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('check_in', '>', now());
    }

    public function scopeCurrent($query)
    {
        return $query->where('check_in', '<=', now())
                    ->where('check_out', '>=', now());
    }

    // Helper methods
    public function getTotalNightsAttribute()
    {
        return $this->check_in->diffInDays($this->check_out);
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'warning',
            'confirmed' => 'success',
            'cancelled' => 'danger',
            'completed' => 'primary'
        ];

        return $badges[$this->status] ?? 'secondary';
    }

    public function canBeCancelled()
    {
        return in_array($this->status, ['pending', 'confirmed']) && 
               $this->check_in->gt(now()->addDays(1));
    }

    public function canBeReviewed()
    {
        return $this->status === 'completed' && 
               $this->check_out->lt(now()) &&
               !$this->review()->exists();
    }

    public function getFormattedDatesAttribute()
    {
        return $this->check_in->format('M j') . ' – ' . $this->check_out->format('M j, Y');
    }
}
