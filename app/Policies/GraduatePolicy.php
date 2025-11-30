<?php

namespace App\Policies;

use App\Models\Graduate;
use App\Models\User;

class GraduatePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Graduate $graduate): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Graduate $graduate): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Graduate $graduate): bool
    {
        return $user->roles <= 2;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Graduate $graduate): bool
    {
        return $user->roles <= 2;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Graduate $graduate): bool
    {
        return $user->roles <= 2;
    }
}
