<?php

namespace App\Policies;

use App\Models\Operator;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OperatorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Operator::whereEmail($user->email)->whereActive(true)->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Operator $operator): bool
    {
        return $user->id === $operator->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Operator::whereEmail($user->email)->whereActive(true)->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Operator $operator): bool
    {
        return $user->email === $operator->email;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Operator $operator): bool
    {
        return $user->email !== $operator->email;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Operator $operator): bool
    {
        return $user->email !== $operator->email;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Operator $operator): bool
    {
        return false;
    }
}
