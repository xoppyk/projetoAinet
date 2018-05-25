<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    const NUM_PER_PAGE = 30;

    public function ofUser(User $user)
    {
        $accounts = $user->accounts()->with('accountType')->paginate(static::NUM_PER_PAGE);
        return view('accounts.ofUser', compact('accounts', 'user'));
    }

    public function ofUserOpened(User $user)
    {
        $accounts = $user->accounts()->where('deleted_at', null)->paginate(static::NUM_PER_PAGE);
        return view('accounts.ofUser', compact('accounts', 'user'));
    }

    public function ofUserClosed(User $user)
    {
        $accounts = $user->accounts()->whereNotNull('deleted_at')->paginate(static::NUM_PER_PAGE);
        return view('accounts.ofUser', compact('accounts', 'user'));
    }
}
