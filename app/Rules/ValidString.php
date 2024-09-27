<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidString implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! preg_match('/^[\pL\s]+$/u', $value)) {
            $fail($this->message());
        }
    }
    public function message()
    {
        return 'Ops! O nome que você escolheu não é válido. Tente não utilizar caracteres especiais.';
    }
}
