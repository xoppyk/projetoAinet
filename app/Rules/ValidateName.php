<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * [ValidateName will be validate if the name only contains spaces and letters]
 */
class ValidateName implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^[\pL\s]+$/u', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Name must be contains only Spaces and Letters';
    }
}
