<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConvertionRequest;
use App\Integrations\AwesomeApi\CurrenciesIntegration;
use App\Models\Convertion;
use App\Repositories\CoodeshConvertionRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    protected $rep;

    public function __construct()
    {
        $this->rep = new CoodeshConvertionRepository();
    }

    public function home(Request $request)
    {
        $int = new CurrenciesIntegration();
        $currencies = [];
        $results = $int->listCombinations();
        // dd($results);
        foreach ($results as $key => $value) {
            if(strpos($key, 'BRL-') !== false) {
                $currencies[$key] = explode('/', $value)[1];
            }
        }


        return view('home', ['currencies' => $currencies]);
    }

    public function convert(ConvertionRequest $request)
    {
        $this->rep->convert(
            $request->amount,
            'BRL',
            str_replace('BRL-', '', $request->currency),
            $request->payment_method
        );

        return back()->with('success', 'Conversão criada com sucesso');
    }

    public function getConvertions(Request $request) {
        $columns = [
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
            'converted_discounted_amount',
            'created_at'
        ];

        $model = Convertion::query();

        if($request->has('order')) {
            $model = $model->orderBy($columns[$request->order[0]['column']], $request->order[0]['dir']);
        }

        return DataTables::eloquent($model)
            ->filter(function ($q) use ($request) {
                $q->where('from', 'like', '%'.request('search.value').'%')
                    ->orWhere('to', 'like', '%'.request('search.value').'%');
            })
            ->addColumn('created_at', function (Convertion $conv) {
                return Carbon::parse($conv->created_at)->diffForHumans();
            })
            ->addColumn('from', function (Convertion $conv) {
                return $conv->from;
            })
            ->addColumn('to', function (Convertion $conv) {
                return $conv->to;
            })
            ->addColumn('amount', function (Convertion $conv) {
                return Convertion::formatCurrency($conv->amount, $conv->from);
            })
            ->addColumn('payment_method', function (Convertion $conv) {
                return $conv->metodoPagamento;
            })
            ->addColumn('converted_discounted_amount', function (Convertion $conv) {
                return Convertion::formatCurrency($conv->converted_discounted_amount, $conv->to);
            })
            ->addColumn('payment_tax', function (Convertion $conv) {
                return Convertion::formatCurrency($conv->payment_tax, $conv->from);
            })
            ->addColumn('convertion_tax', function (Convertion $conv) {
                return Convertion::formatCurrency($conv->convertion_tax, $conv->from);
            })
            ->addColumn('discounted_amount', function (Convertion $conv) {
                return Convertion::formatCurrency($conv->discounted_amount, $conv->from);
            })
            ->rawColumns($columns)
            ->toJson();
    }
}
