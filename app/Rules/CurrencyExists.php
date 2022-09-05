<?php

namespace App\Rules;

use App\Integrations\AwesomeApi\CurrenciesIntegration;
use Illuminate\Contracts\Validation\Rule;

class CurrencyExists implements Rule
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
        return in_array($value, array_keys($int->listCurrencies()));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You must choose a valid currency to convert';
    }
}
