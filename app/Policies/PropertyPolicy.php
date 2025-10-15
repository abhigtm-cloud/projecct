<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any properties.
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the property.
     */
    public function view(User $user, Property $property)
    {
        return true;
    }

    /**
     * Determine whether the user can create properties.
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the property.
     */
    public function update(User $user, Property $property)
    {
        // User can update if they own the property
        return $user->id === $property->user_id;
    }

    /**
     * Determine whether the user can delete the property.
     */
    public function delete(User $user, Property $property)
    {
        // User can delete if they own the property
        return $user->id === $property->user_id;
    }

    /**
     * Determine whether the user can restore the property.
     */
    public function restore(User $user, Property $property)
    {
        return $user->id === $property->user_id;
    }

    /**
     * Determine whether the user can permanently delete the property.
     */
    public function forceDelete(User $user, Property $property)
    {
        return $user->id === $property->user_id;
    }
}