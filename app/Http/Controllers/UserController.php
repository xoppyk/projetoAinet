<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Gate;

class UserController extends Controller
{
    const NUM_PER_PAGE = 20;

    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        $users = User::latest()
            ->filter(request(['status', 'type', 'name']))
            ->paginate(static::NUM_PER_PAGE);

        return view('users.index', compact('users'));
    }

    public function unblock(User $user)
    {
        $this->ifHimSelf($user);

        $user->blocked = 0;
        $user->save();
        return redirect()
            ->route('users.index')
            ->with(['type' => 'success', 'message' => 'User Unblocked']);
    }

    public function block(User $user)
    {
        $this->ifHimSelf($user);

        $user->blocked = 1;
        $user->save();
        return redirect()
            ->route('users.index')
            ->with(['type' => 'success', 'message' => 'User Blocked']);
    }

    public function promote(User $user)
    {
        $this->ifHimSelf($user);

        $user->admin = 1;
        $user->save();
        return redirect()
            ->route('users.index')
            ->with(['type' => 'success', 'message' => 'User Promoted']);
    }

    public function demote(User $user)
    {
        $this->ifHimSelf($user);
        // return $user->can('demote', $this->user);
        // $this->authorize('demote', \Auth::user());

        $user->admin = 0;
        $user->save();
        return redirect()
            ->route('users.index')
            ->with(['type' => 'success', 'message' => 'User Demoted']);
    }

    public function ifHimSelf(User $user)
    {
        $authUser = \Auth::user();
        if ($authUser->cant('himself', $user)) {
            abort(403, 'Unauthorized action.');
        }
    }
}
