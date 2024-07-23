<?php

namespace App\Policies;

use App\Models\Asset;
use App\Models\User;

class AssetPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if (auth()->user()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Asset $asset): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Check if the user is a superadmin or admin
        if ($user->role->value === 'superadmin' || $user->role->value === 'admin') {
            return true; // Allow deletion
        }

        return false; // Deny deletion    }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Asset $asset): bool
    {
        // Check if the user is a superadmin or admin
        if ($user->role->value === 'superadmin' || $user->role->value === 'admin') {
            return true; // Allow deletion
        }

        return false; // Deny deletion    }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Asset $asset): bool
    {
        // Check if the user is a superadmin or admin
        if ($user->role->value === 'superadmin' || $user->role->value === 'admin') {
            return true; // Allow deletion
        }

        return false; // Deny deletion    }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Asset $asset): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Asset $asset): bool
    {
        //
    }
}
