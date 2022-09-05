<?php

namespace App\Integrations\AwesomeApi;

use Exception;

class CurrenciesIntegration extends CurrenciesBaseRequest
{

    public function listCurrencies(): array
    {
        return json_decode(json_encode(simplexml_load_file('https://economia.awesomeapi.com.br/xml/available/uniq')), true);
    }

    public function listCombinations(): array
    {
        return json_decode(json_encode(simplexml_load_file('https://economia.awesomeapi.com.br/xml/available')), true);
    }

    public function getQuote(string $from, string $to): array
    {
        $response = $this->get('/last/' . $from . '-' . $to)->json();
        return $response[$from.$to];
    }
}
