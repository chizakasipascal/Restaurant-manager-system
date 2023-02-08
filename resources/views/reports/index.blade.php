@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12  shadown-sm d-flex align-items-center justify-content-center">
                                <form action="{{ route('reports.show') }}" method="POST">
                                    @csrf
                                    <div class="from-group">
                                        <label for="form">Start date</label>
                                        <input type="date" name="from" class="form-control" id="form">
                                    </div>

                                    <div class="from-group">
                                        <label for="form">End date</label>
                                        <input type="date" name="to" class="form-control" id="to">
                                    </div>
                                    <div class="form-group mt-2">
                                        <button type="submit" class="btn btn-primary">
                                            Afficher le rapport
                                        </button>
                                    </div>
                                </form>
                            </div>
                            @isset($total)
                                <div class="row my-4">
                                    <div class="col-md-10  mx-auto">
                                        <h4 class="text-secondary font-weight-bold">
                                            Rapport de {{ $startDate }} à {{ $endDate }}
                                        </h4>
                                        <div class="card">
                                            <div class="card-body">
                                                <table class="table table-hover table-responsive-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Menus</th>
                                                            <th>Tables</th>
                                                            <th>Sérveur</th>
                                                            <th>Quantité</th>
                                                            <th>Total</th>
                                                            <th>Type de paiement</th>
                                                            <th>Etat de paiement</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($sales as $sale)
                                                            <tr>
                                                                <td>
                                                                    {{ $sale->id }}
                                                                </td>
                                                                <td>
                                                                    @foreach ($sale->menus()->where('sale_id', $sale->id)->get() as $menu)
                                                                        <div class="col-md-4 mb-2">
                                                                            <div class="h-100">
                                                                                <div
                                                                                    class="d-flex
                                                                                        flex-column justify-content-center
                                                                                        align-items-center">
                                                                                    <h5 class="font-weight-bold mt-2">
                                                                                        {{ $menu->title }}
                                                                                    </h5>
                                                                                    <h5 class="text-muted">
                                                                                        {{ $menu->price }} $
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </td>
                                                                <td>
                                                                    @foreach ($sale->tables()->where('sale_id', $sale->id)->get() as $table)
                                                                        <div class="col-md-4 mb-2">
                                                                            <div class="h-100">
                                                                                <div
                                                                                    class="d-flex
                                                                                    flex-column justify-content-center
                                                                                    align-items-center">
                                                                                    <i class="fa fa-chair fa-3x"></i>
                                                                                    <h5 class="text-muted mt-2">
                                                                                        {{ $table->name }}
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </td>
                                                                <td>
                                                                    {{ $sale->servant->name }}
                                                                </td>
                                                                <td>
                                                                    {{ $sale->quantity }}
                                                                </td>
                                                                <td>
                                                                    {{ $sale->total }}
                                                                </td>
                                                                <td>
                                                                    {{ $sale->payment_type === 'cash' ? 'Espéce' : 'Carte bancaire' }}
                                                                </td>
                                                                <td>
                                                                    {{ $sale->payment_status === 'paid' ? 'Payé' : 'Impayé' }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>

                                                </table>
                                                <p class="text-danger text-center font-weight-bold">
                                                    <span class="border border-danger p-2">
                                                        Total : {{ $total }} $
                                                    </span>
                                                </p>
                                                <form action="#" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type="hidden" name="from" value="{{ $startDate }}"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="hidden" name="to" value="{{ $endDate }}"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="btn btn-danger">
                                                            Génerer le rapport excel
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
