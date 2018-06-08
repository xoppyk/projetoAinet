<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;
use Route;

class MovementStoreRequest extends FormRequest
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
        // $account = Route::current()->parameter('account');
        return [
                'movement_category_id' => 'required|exists:movement_categories,id',
                'date' => 'required|date',
                'value' => ['required', 'numeric','min:0.1'],
                'description' => 'nullable|string',
                'document_file' => 'nullable|mimes:png,jpeg,pdf|required_with:document_description',
                'document_description' => 'nullable|string',
        ];
    }
}
