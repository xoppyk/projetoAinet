<?php

namespace App\Http\Controllers\Auth;

use App\User;

use App\Rules\ValidateName;

use Illuminate\Http\File;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UploadFileController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', new ValidateName, 'max:255'],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
            'phone' => 'nullable|digits:9',
            'profile_photo' => 'image',
        ]
    );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if (!empty($data['profile_photo']) && $data['profile_photo']->isValid()) {
            $photo = $data['profile_photo'];
            //FIXME Perguntar ao stor
            $path = UploadFileController::store('public/profiles', $photo);
            $photo_name = UploadFileController::splitPath($path);
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'profile_photo' => $photo_name ?? null ,
            'phone' => $data['phone'],
        ]);

    }
}
