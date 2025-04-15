<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine if the user is an admin.
     *
     * @param User $user
     * @return bool
     */
    public function admin(User $user): bool
    {
        return $user->role === 'admin';
    }
    
    /**
     * Determine if the user can access admin dashboard.
     *
     * @param User $user
     * @return bool
     */
    public function dashboard(User $user): bool
    {
        return $user->role === 'admin';
    }
    
    /**
     * Determine if the user can manage animals.
     *
     * @param User $user
     * @return bool
     */
    public function manageAnimals(User $user): bool
    {
        return $user->role === 'admin';
    }
    
    /**
     * Determine if the user can manage appointments.
     *
     * @param User $user
     * @return bool
     */
    public function manageAppointments(User $user): bool
    {
        return $user->role === 'admin';
    }
    
    /**
     * Determine if the user can manage adoptions.
     *
     * @param User $user
     * @return bool
     */
    public function manageAdoptions(User $user): bool
    {
        return $user->role === 'admin';
    }
    
    /**
     * Determine if the user can manage users.
     *
     * @param User $user
     * @return bool
     */
    public function manageUsers(User $user): bool
    {
        return $user->role === 'admin';
    }
    
    /**
     * Determine if the user can manage reports.
     *
     * @param User $user
     * @return bool
     */
    public function manageReports(User $user): bool
    {
        return $user->role === 'admin';
    }
}
