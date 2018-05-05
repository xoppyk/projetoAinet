<?php

namespace App\Http\Controllers;

use App\User;

use App\Http\Requests\UserUpdateProfile;
use App\Http\Requests\UserUpdatePassword;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //FIXME Tentar Usar isto
    // public function __constructor()
    // {
    //     $this->$user = \Auth::user();
    // }
    public function editProfile()
    {
        $user = Auth::user();
        return view('me.editProfile', compact('user'));
    }

    public function updateProfile(UserUpdateProfile $request)
    {
        $updatedUser = $request->validated();
        $user = Auth::user();

        $user->fill($updatedUser);
        $user->save();

        return redirect()
            ->route('home')
            ->with(['type' => 'success', 'message' => 'User Changed With Success']);
    }

    public function editPassword()
    {
        return view('me.editPassword');
    }

    public function updatePassword(UserUpdatePassword $request)
    {
        $data = $request->validated();
        $user = Auth::user();
        // if (!Hash::check($user->password, $data['old_password'])) {
        // dump(Hash::($data['old_password']));
        if (!Hash::check($data['old_password'], $user->password)) {
            return redirect()
                ->back()
                ->with(['type' => 'danger', 'message' => 'Old Password is Wrong']);
                // ->with(['errors' => ['old_password' => 'Old Password Is Wrong']]);
        }

        $user->password = bcrypt($data['password']);
        $user->save();

        return redirect()
            ->route('me.editProfile')
            ->with(['type' => 'success', 'message' => 'Password Changed With Success']);

    }
}
