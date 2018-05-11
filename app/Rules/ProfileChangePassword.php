<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ProfileChangePassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    protected $password;
    public function __construct($oldPassword)
    {
        $this->password = $oldPassword;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value, $passord)
    {
        if (Hash::check($value, $password)) {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Old Password is Invalid';
    }
}
