<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneRule implements ValidationRule
{
    public function validate(string $attribute, $value, Closure $fail): void
    {
        if (! preg_match('/^\+5939\d{8}$/', $value)) {
            $fail('El campo phone no cumple con el formato esperado.');
        }
    }
}
