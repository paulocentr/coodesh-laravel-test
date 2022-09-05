<?php

namespace App\Rules;

use App\Integrations\AwesomeApi\CurrenciesIntegration;
use Illuminate\Contracts\Validation\Rule;

class CombinationExists implements Rule
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
        $int = new CurrenciesIntegration();
        return in_array($value, array_keys($int->listCombinations()));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
