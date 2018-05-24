<?php

namespace App\Http\Controllers;

use App\User;

use App\Http\Requests\UserUpdateProfile;
use App\Http\Requests\UserUpdatePassword;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    const NUM_PER_PAGE = 30;

    public function index()
    {
        $user = \Auth::user();

        $users = User::latest()
            ->filter(request(['name']))
            ->paginate(static::NUM_PER_PAGE);

        $associates = $user->associates()->get();
        $associatesOf = $user->associatesOf()->get();

        return view('me.index', compact('users', 'associates', 'associatesOf'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('me.profile.editProfile', compact('user'));
    }

    public function updateProfile(UserUpdateProfile $request)
    {
        $updatedUser = $request->validated();
        $user = Auth::user();

        if (!empty($updatedUser['profile_photo'])) {
            $photo_name = basename($request['profile_photo']->store('profiles','public'));
            if ($user->profile_photo != null) {
                Storage::delete('public/profiles/'.$user->profile_photo);
            }
            $user->profile_photo = $photo_name;
        }
        if (empty($updatedUser->phone)) {
            $user->phone = null;
        }

        $user->fill(array_except($updatedUser, 'profile_photo'));
        $user->save();

        return redirect()
            ->route('home')
            ->with(['type' => 'success', 'message' => 'User Changed With Success']);
    }

    public function editPassword()
    {
        return view('me.profile.editPassword');
    }

    public function updatePassword(UserUpdatePassword $request)
    {
        $user = Auth::user();
        $this->authorize('updatePassword', $user);

        $data = $request->validated();

        $user->password = bcrypt($data['password']);
        $user->save();

        return redirect()
            ->route('me.profile.editProfile')
            ->with(['type' => 'success', 'message' => 'Password Changed With Success']);
    }

    public function associates(){

        $associates = \Auth::user()->associates()->paginate(static::NUM_PER_PAGE);
        return view('me.associates', compact('associates'));
    }

     public function associatesOf(){

        $associatesOf = \Auth::user()->associatesOf()->paginate(static::NUM_PER_PAGE);
        return view('me.associatesOf', compact('associatesOf'));
    }

}
