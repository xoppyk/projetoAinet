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

    public function __construct()
    {
        $this->middleware(['auth', 'himself']);
    }

    public function index()
    {
        $user = \Auth::user();
        $users = User::paginate(static::NUM_PER_PAGE);

        $associates = $user->associates()->get()->id;
        $associatesOf = $user->associatesOf()->get();

        return view('me.index', compact('users', 'associates', 'associatesOf'));
    }

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
        return view('me.editPassword');
    }

    public function updatePassword(UserUpdatePassword $request)
    {
        $user = Auth::user();
        $this->authorize('updatePassword', $user);

        $data = $request->validated();
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
