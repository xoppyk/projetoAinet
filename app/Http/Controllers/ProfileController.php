<?php

namespace App\Http\Controllers;

use App\User;

use App\Http\Requests\UserUpdateProfile;

class ProfileController extends Controller
{
    public function edit(User $user)
    {
        return view('me.edit', compact('user'));
    }

    public function update(UserUpdateProfile $request)
    {
        $updatedUser = $request->validated();

        $user = \Auth::user();

        $user->fill($updatedUser);
        $user->save();

        return redirect()
            ->route('home')
            ->with('success', 'User Updated With Success');
    }
}
