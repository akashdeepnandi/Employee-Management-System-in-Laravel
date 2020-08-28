<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DateRange implements Rule
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
        [$start, $end] = explode(' - ', $value);
        return $start != $end;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Select a proper date range';
    }
}
