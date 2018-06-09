<?php

namespace App\Policies;

use App\User;
use App\Account;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    public function isOwner(User $user, Account $account)
    {
        return $user->id == $account->owner_id;
    }

    public function haveAccess(User $user, Account $account)
    {
        $users = $user->associates->pluck('id');
        $users[] = $user->id;
        return in_array($user->id, $users->toArray());
    }
}
