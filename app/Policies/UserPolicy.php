<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given view can be used by the user.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function view(User $user)
    {
        return $user->role === 0;
    }

    /**
     * Determine if the given view can be update by the user.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function update(User $user)
    {
        return $user->role === 0;
    }
}
