@extends('layouts.site_master')

@section('title', 'Test Coodesh Php application')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h4>
                Teste Coodesh
            </h4>
            <div class="card">
                <div class="card-header">
                    <form method="POST" action="{{ route('site.convert') }}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="amount">Montante (R$)</label>
                                <input type="number" id="amount" class="form-control {{ ($errors->has('amount'))?'is-invalid':'' }}" name="amount" value="{{ old('amount') }}" required>
                                @if ($errors->has('amount'))
                                <div class="invalid-feedback">{{ $errors->first('amount') }}</div>
                                @endif
                            </div>
                            <div class="col">
                                <label for="currency">Converter para</label>
                                <select name="currency" id="currency" class="form-control select2 {{ ($errors->has('currency'))?'is-invalid':'' }}" required>
                                    <option value="teste">Escolha</option>
                                    @foreach ($currencies as $key => $value)
                                    <option {{ (old('currency')==$key)?'selected':'' }} value="{{ $key }}">{{ str_replace('BRL-', '', $key) }} - {{ $value }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('currency'))
                                <div class="invalid-feedback">{{ $errors->first('currency') }}</div>
                                @endif
                            </div>
                            <div class="col">
                                <label for="payment_method">Forma de pagamento</label>
                                <select name="payment_method" id="payment_method" class="form-control select2 {{ ($errors->has('payment_method'))?'is-invalid':'' }}" required>
                                    <option value="teste">Escolha</option>
                                    @foreach (config('coodesh.payment_methods') as $key => $value)
                                    <option {{ (old('payment_method')==$key)?'selected':'' }} value="{{ $key }}">{{ $value['name'] }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('payment_method'))
                                <div class="invalid-feedback">{{ $errors->first('payment_method') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col pt-2">
                                <button type="submit" class="btn btn-success">Converter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col table-responsive">
                            <table class="table" id="tabela">
                                <thead>
                                    <th>Data</th>
                                    <th>De</th>
                                    <th>Para</th>
                                    <th>Montante</th>
                                    <th>Forma de Pagamento</th>
                                    <th>Taxas</th>
                                    <th>Total</th>
                                    <th>Total Convertido</th>
                                    <th>Descontos</th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(function() {
        tabela()
    });
    function tabela() {
        $('#tabela').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! route('site.conversions') !!}',
            },
            order: [
                [0, 'desc']
            ],
            columns: [
                { data: 'created_at', name: 'created_at' },
                { data: 'from', name: 'from' },
                { data: 'to', name: 'to' },
                { data: 'amount', name: 'amount' },
                { data: 'payment_method', name: 'payment_method' },
                { data: 'payment_tax', name: 'payment_tax' },
                { data: 'converted_discounted_amount', name: 'converted_discounted_amount' },
                { data: 'discounted_amount', name: 'discounted_amount' },
                { data: 'convertion_tax', name: 'convertion_tax' },
            ]
        });
    }
</script>
@endsection