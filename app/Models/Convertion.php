<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NumberFormatter;

class Convertion extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to',
        'amount',
        'payment_method',
        'tax_value',
        'extra_tax_value',
        'convertion_rate',
        'total_converted_value',
        'payment_tax',
        'convertion_tax',
        'discounted_amount',
        'converted_discounted_amount'
    ];

    protected $appends = ['metodoPagamento'];

    public static function formatCurrency($amount, $code): string
    {
        $formatter = new NumberFormatter('pt_BR', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($amount, $code);
    }

    public function getMetodoPagamentoAttribute()
    {
        return config('coodesh.payment_methods.' . $this->payment_method . '.name');
    }
}
