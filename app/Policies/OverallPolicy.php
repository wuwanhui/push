<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OverallPolicy
{
    use HandlesAuthorization;


    public function before(User $user)
    {
        if ($user->type == 0) {
            return true;
        }
    }


    public function manage(User $user)
    {
        if ($user->type == 0) {
            return true;
        }
        return false;
    }

    public function member(User $user)
    {
        if ($user->type != 0) {
            return true;
        }
        return false;
    }

}
