<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AuthorRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $flag = true;

        if(is_null($value) || !is_string($value) || empty(trim($value)))
        {
            $flag = false;
        }

        return $flag;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute validation fails';
    }
}
