<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConvertionRequest;
use App\Integrations\AwesomeApi\CurrenciesIntegration;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home(Request $request) {
        $int = new CurrenciesIntegration();

        return view('home', ['currencies' => $int->listCurrencies()]);
    }

    public function convert(ConvertionRequest $request) {
        dd($request->validated());
    }
}
