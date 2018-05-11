<?php

namespace App\Http\Requests;

use App\Rules\ProfileChangePassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserUpdatePassword extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => ['required','string','min:3', new ProfileChangePassword(Auth::user()->password)],
            'password' => 'required|string|min:3|confirmed',
        ];
    }
}
