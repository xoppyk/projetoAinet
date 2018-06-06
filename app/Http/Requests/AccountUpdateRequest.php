<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Route;
use Illuminate\Foundation\Http\FormRequest;

class AccountUpdateRequest extends FormRequest
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
        $account = Route::current()->parameter('account');
        return [
            'account_type_id' => 'required|exists:account_types,id',
            'code' => ['required', Rule::unique('accounts')->where(function ($query) {
                return $query->where('owner_id', \Auth::id());
            })->ignore($account->code, 'code')],
            'start_balance' => 'required|numeric',
            'description' => 'nullable|string',
            'date' => 'required|date'
        ];
    }
}
