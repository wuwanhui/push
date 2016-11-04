<?php

namespace App\Policies;

use App\Models\Enterprise;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EnterprisePolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ($user->type == 0) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the enterprise.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Enterprise $enterprise
     * @return mixed
     */
    public function view(User $user, Enterprise $enterprise)
    {
        //
    }

    /**
     * Determine whether the user can create enterprises.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->type == 0) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the enterprise.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Enterprise $enterprise
     * @return mixed
     */
    public function update(User $user, Enterprise $enterprise)
    {
        if ($user->type == 2 && $user->enterpriseId == $enterprise->id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the enterprise.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Enterprise $enterprise
     * @return mixed
     */
    public function delete(User $user, Enterprise $enterprise)
    {
        //
    }
}
