<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsbnRule implements Rule
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

        //validation fails, if isbn is not a string
        if(!is_string($value) || is_null($value) || empty(trim($value)))
        {
            return $flag;
        }

        $isbns = explode(';',$value);

        foreach($isbns as $isbn)
        {
            if($isbn){
                //
                $flag = preg_match('/^[0-9]{10}$/', $isbn) ? true : (preg_match('/^[0-9]{13}$/', $isbn) ? true : false);
                if(!$flag)
                {
                    break;
                }
            }
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
