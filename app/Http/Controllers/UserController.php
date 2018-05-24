<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Gate;

class UserController extends Controller
{
    const NUM_PER_PAGE = 10;

    public function index()
    {
        $users = User::latest()
            ->filter(request(['status', 'type', 'name']))
            ->paginate(static::NUM_PER_PAGE);


        return view('admin.users.index', compact('users'));
    }


    public function toggleState(User $user)
    {
        if ($user->blocked) {
            return $this->unblock($user);
        }
        return $this->block($user);
    }

    public function unblock(User $user)
    {
        $this->ifHimSelf($user);

        $user->blocked = 0;
        $user->save();
        return redirect()
            ->route('admin.users.index')
            ->with(['type' => 'success', 'message' => 'User Unblocked']);
    }


    public function block(User $user)
    {
        $this->ifHimSelf($user);

        $user->blocked = 1;
        $user->save();
        return redirect()
            ->route('admin.users.index')
            ->with(['type' => 'success', 'message' => 'User Blocked']);
    }

    public function toggleType(User $user)
    {
        if ($user->admin) {
            return $this->demote($user);
        }
        return $this->promote($user);
    }


    public function promote(User $user)
    {
        $this->ifHimSelf($user);

        $user->admin = 1;
        $user->save();
        return redirect()
            ->route('admin.users.index')
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
            ->route('admin.users.index')
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
