<?php

namespace App\Interfaces;

interface ConvertionInterface
{
    public function convert(
        float $amount,
        string $from,
        string $to,
        string $payment_method
    );
}
