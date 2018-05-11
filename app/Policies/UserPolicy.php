<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->admin) {
            return true;
        }
    }

    public function index(User $user)
    {
        return false;
    }

}
