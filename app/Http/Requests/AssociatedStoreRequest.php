<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class AssociatedStoreRequest extends FormRequest
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
        $notInUser = $user->associates->pluck('id');
        $notInUser[] = $user->id;
        return [
            'associated_user' => [
                    'required',
                    'exists:users,id',
                    Rule::notIn($notInUser),
                ]
        ];
    }
}
