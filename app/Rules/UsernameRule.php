<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UsernameRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

    public function passes($attribute, $value)
    {
        // Add your custom validation logic for the username here
        // For example, you can use regular expressions or other methods
        return preg_match('/^[a-zA-Z0-9_]+$/', $value);
    }

    public function message()
    {
        return 'The :attribute must only contain letters, numbers, and underscores.';
    }
}
