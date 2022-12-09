<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OffsetRule implements Rule
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
        $flag = false;

        if(is_null($value))
        {
            return $flag;
        }

        $flag = preg_match('/^\\d+$/',$value)? ($value % 20 ? false : true) : false;

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
