<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidISBN implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isbn = str_replace([' ', '-'], '', $value);

        if(strlen($isbn) == 10) {
            $this->isValidIsbn10($isbn);
        } elseif(strlen($isbn) == 13) {
            $this->isValidIsbn13($isbn);
        }
    }

    public function message(): string {
        return 'O atributo não é um ISBN valido.';
    }

    protected function isValidIsbn10($isbn)
    {
        $sum = 0;
        for($i = 0; $i < 9; $i++) {
            if(!is_numeric($isbn[$i])) return false;
            $sum += (10 - $i) * $isbn[$i];
        }

        $checksum = strtolower($isbn[9]) == 'x' ? 10 : $isbn[9];

        if(!is_numeric($checksum) && strtolower($checksum) != 'x') return false;

        $sum += $checksum;

        return $sum % 11 == 0;
    }

    protected function isValidIsbn13($isbn)
    {
        $sum = 0;
        for($i = 0; $i < 12; $i++) {
            $sum += (is_numeric($isbn[$i]) ? $isbn[$i] : 0) * ($i % 2 == 0 ? 1 : 3);
        }

        $checksum = (10 - ($sum % 10)) % 10;
        return $checksum == $isbn[12];
    }
}
