<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfileChangePassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $potato;
    public function __construct($oldPassword)
    {
        $this->potato = $oldPassword;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {   
        if (Hash::check($value, $this->potato)) {
            return true;
        }
        return false;
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
