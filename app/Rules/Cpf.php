<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Cpf implements Rule
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
        // Removendo os cacracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $value);

        // Verificando se tem 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verificação de todos os digitos para ver se são iguais (CPF inválido)
        if (preg_match('/^(\d)\1+$/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $$t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t - 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O CPF informado é inválido';
    }
}