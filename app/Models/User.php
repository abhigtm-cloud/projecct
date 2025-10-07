<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'password',
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
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',
            'is_host' => 'boolean',
            'is_verified' => 'boolean',
            'languages' => 'array',
            'last_active_at' => 'datetime'
        ];
    }

    // NextBNB Relationships
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function wishlistedProperties()
    {
        return $this->belongsToMany(Property::class, 'wishlists');
    }

    // Helper methods
    public function getFullNameAttribute()
    {
        return trim("{$this->first_name} {$this->last_name}") ?: $this->name;
    }

    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo 
            ? asset('storage/' . $this->profile_photo)
            : asset('images/default-avatar.png');
    }

    public function getInitialsAttribute()
    {
        $name = $this->full_name;
        $words = explode(' ', $name);
        $initials = '';
        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        return substr($initials, 0, 2);
    }

    public function isHosting()
    {
        return $this->is_host && $this->properties()->where('is_active', true)->exists();
    }

    public function totalEarnings()
    {
        return $this->properties()
            ->withSum(['bookings' => function($query) {
                $query->where('status', 'completed');
            }], 'total_amount')
            ->get()
            ->sum('bookings_sum_total_amount');
    }
}
