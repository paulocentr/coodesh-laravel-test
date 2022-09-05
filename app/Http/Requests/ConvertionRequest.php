<?php

namespace App\Http\Requests;

use App\Rules\CombinationExists;
use App\Rules\CurrencyExists;
use Illuminate\Foundation\Http\FormRequest;

class ConvertionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payment_method' => ['required', 'in:'.implode(',', array_keys(config('coodesh.payment_methods')))],
            'currency' => ['required', new CombinationExists()],
            'amount' => ['required', 'gt:'.config('coodesh.min_convertion_amount'), 'lt:'.config('coodesh.max_convertion_amount')]
        ];
    }
}
