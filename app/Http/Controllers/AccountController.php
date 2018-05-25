<?php

namespace App\Http\Controllers;

use App\Account;
use App\User;
use Illuminate\Http\Request;
use \App\Movement;

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

    public function destroy(Account $account){
        
        if(!$account->movements()->get()->isEmpty() || !is_null($account->last_movement_date)){
            return abort(403, 'Can not delete account with movements');
        }
        if(\Auth::id() != $account->owner_id){
           return abort(403, 'User can only delete his account');
        }

        $account->delete();
        return redirect()
        ->route('accounts.ofUser', \Auth::user())
        ->with('success', 'Account deleted successfully.');
    }

    
}
