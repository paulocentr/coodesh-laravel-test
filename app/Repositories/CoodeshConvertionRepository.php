<?php

namespace App\Repositories;

use App\Integrations\AwesomeApi\CurrenciesIntegration;
use App\Interfaces\ConvertionInterface;
use App\Models\Convertion;

class CoodeshConvertionRepository implements ConvertionInterface
{

    public function convert(
        float $amount,
        string $from,
        string $to,
        string $payment_method
    ): Convertion {
        $tax_value = config('coodesh.payment_methods.' . $payment_method . '.tax');
        $extra_tax_value = $this->calculateExtraFee($amount);

        // now we calculate the conversion
        $integration = new CurrenciesIntegration();
        // ask is the price that the currency is being selled for
        $convertion_rate = $integration->getQuote($from, $to)['ask'];

        $total_converted_value = $convertion_rate * $amount;

        $payment_tax = $amount * ($tax_value / 100);
        $convertion_tax = $amount * ($extra_tax_value / 100);

        $discounted_amount = $amount - $payment_tax - $convertion_tax;

        $converted_discounted_amount = $discounted_amount * $convertion_rate;

        $data = [
            'from' => $from,
            'to' => $to,
            'amount' => $amount,
            'payment_method' => $payment_method,
            'tax_value' => $tax_value,
            'extra_tax_value' => $extra_tax_value,
            'convertion_rate' => $convertion_rate,
            'total_converted_value' => $total_converted_value,
            'payment_tax' => $payment_tax,
            'convertion_tax' => $convertion_tax,
            'discounted_amount' => $discounted_amount,
            'converted_discounted_amount' => $converted_discounted_amount
        ];

        return Convertion::create($data);
    }


    protected function calculateExtraFee(float $amount): float
    {
        return ($amount >= config('coodesh.extra_convertion_fees.gt.value')) ? config('coodesh.extra_convertion_fees.gt.tax') : config('coodesh.extra_convertion_fees.lt.tax');
    }
}
