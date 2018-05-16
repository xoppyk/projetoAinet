<?php

namespace App\Http\Requests;

use App\Rules\ValidateName;
use App\Rules\ValidatePhone;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateProfile extends FormRequest
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
        $user = \Auth::user();
        return [
            'name' => ['required', new ValidateName],
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => ['nullable', new ValidatePhone],
            'profile_photo' => 'image',
        ];
    }
}
