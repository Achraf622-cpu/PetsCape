<?php

namespace App\Policies;

use App\Models\AnimalReport;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnimalReportPolicy
{
    use HandlesAuthorization;

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
    public function view(User $user, AnimalReport $report): bool
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
    public function update(User $user, AnimalReport $report): bool
    {
        return $user->id === $report->user_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AnimalReport $report): bool
    {
        return $user->id === $report->user_id || $user->role === 'admin';
    }
} 