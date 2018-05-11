<?php

namespace App\Http\Controllers;

use App\User;

use App\Http\Requests\UserUpdateProfile;
use App\Http\Requests\UserUpdatePassword;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function editProfile()
    {
        $user = Auth::user();
        return view('me.editProfile', compact('user'));
    }

    public function updateProfile(UserUpdateProfile $request)
    {
        $updatedUser = $request->validated();
        $user = Auth::user();

        if (!empty($updatedUser['profile_photo'])) {
            $photo_name = basename($data['profile_photo']->store('profiles','public'));
            if ($user->profile_photo != null) {
                Storage::delete('public/profiles/'.$user->profile_photo);
            }
            $user->profile_photo = $photo_name;
        }

        $user->fill(array_except($updatedUser, 'profile_photo'));
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
        // if (!Hash::check($data['old_password'], $user->password)) {
        //     return redirect()
        //         ->back()
        //         ->with(['type' => 'danger', 'message' => 'Old Password is Wrong']);
        //         // ->with(['errors' => ['old_password' => 'Old Password Is Wrong']]);
        // }

        $user->password = bcrypt($data['password']);
        $user->save();

        return redirect()
            ->route('me.editProfile')
            ->with(['type' => 'success', 'message' => 'Password Changed With Success']);

    }
}
