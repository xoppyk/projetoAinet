<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class AccountStoreRequest extends FormRequest
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
            'account_type_id' => 'required|exists:account_types,id',
            'code' => ['required', Rule::unique('accounts')->where(function ($query) {
                return $query->where('owner_id', \Auth::id());
            })],
            'date' => 'nullable|date',
            'start_balance' => 'required|numeric',
            'description' => 'nullable|string'
        ];
    }
}
