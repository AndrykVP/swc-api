<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Bypass policy for Admin users.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function before($user, $ability)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    /**
     * Determine whether the user can view all records of model.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermission('view-users')
                ? Response::allow()
                : Response::deny('You do not have permissions to view users.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return $user->id === $model->id
                || $user->hasPermission('view-users')
                ? Response::allow()
                : Response::deny('You do not have permissions to view users.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return $user->id === $model->id
                || $user->hasPermission('update-users')
                ? Response::allow()
                : Response::deny('You do not have permissions to edit users.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function uploadArt(User $user)
    {
        return $user->hasPermission('update-users-art')
                ? Response::allow()
                : Response::deny('You do not have permissions to upload IDs.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function changeRank(User $user)
    {
        return $user->hasPermission('update-users-rank')
                ? Response::allow()
                : Response::deny('You do not have permissions to change a user\'s faction info.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasPermission('delete-users')
                ? Response::allow()
                : Response::deny('You do not have permissions to delete users.');
    }
}
