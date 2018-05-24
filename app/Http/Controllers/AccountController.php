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
        return view('accounts.ofUser', compact('accounts'));
    }
}
