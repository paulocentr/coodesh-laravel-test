<?php

namespace App\Integrations\AwesomeApi;

class CurrenciesIntegration extends CurrenciesBaseRequest
{

    public function listCurrencies()
    {
        return json_decode(json_encode(simplexml_load_file('https://economia.awesomeapi.com.br/xml/available/uniq')), true);
    }
}
