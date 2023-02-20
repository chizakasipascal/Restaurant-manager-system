@extends('layouts.app')


@section('content')
    <div class="container" id="report">

        <form action="{{ route('sales.store') }}" method="POST" id="add-sale">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            @include('layouts.sidebar')
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <h3 class="text-muted border-bottom">
                                    <div class="d-flex justify-content-between mb-3">

                                        <h3 class="text-muted border-bottom">
                                            {{ Carbon\Carbon::now() }}
                                        </h3>
                                        <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary">
                                            Toutes les ventes
                                        </a>
                                    </div>

                                </h3>

                                <div class="card">
                                    <h5 class="m-3">Tables disponible</h5>
                                    <div class="card-body">
                                        <div class="row">

                                            @foreach ($tables as $table)
                                                {{-- //TODO: Test if table is close etat --}}


                                                {{-- @if ($table->status == 1) --}}

                                                <div class="col-sm-3">
                                                    <div
                                                        class="card p-2 mb-2 d-flex flex-column justify-content-center align-items-center">
                                                        <div class="algin-self-end mb-2">
                                                            <input type="checkbox" name="table_id[]" id="table"
                                                                value="{{ $table->id }}">
                                                        </div>
                                                        <i class="fas fa-chair fa-5x"></i>
                                                        <span class="mt-2 text-muted font-weight-bold">
                                                            {{ $table->name }}
                                                        </span>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="{{ route('tables.edit', $table->slug) }}"
                                                                class="btn btn-warning btn-sm">
                                                                <i class="fas fa-edit"></i> </a>
                                                        </div>
                                                        <hr>



                                                        @foreach ($table->sales as $sale)
                                                            @if ($sale->created_at >= Carbon\Carbon::today())
                                                                <div style="border :2px dashed pink"
                                                                    class="my-2 shadow w-100" id="{{ $sale->id }}">
                                                                    <div class="card">
                                                                        <div
                                                                            class="card-body d-flex
                                                                                flex-column justify-content-center
                                                                                align-items-center">
                                                                            @foreach ($sale->menus()->where('sale_id', $sale->id)->get() as $menu)
                                                                                <h5 class="font-weight-bold mt-2">
                                                                                    {{ $menu->title }}
                                                                                </h5>
                                                                                <span class="text-muted">
                                                                                    {{ $menu->price }} $
                                                                                </span>
                                                                            @endforeach

                                                                            <h5 class="font-weight-bold mt-2">
                                                                                <span class="badge bg-danger">
                                                                                    Sérveur : {{ $sale->servant->name }}
                                                                                </span>
                                                                            </h5>
                                                                            <h5 class="font-weight-bold mt-2">
                                                                                <span class="badge bg-secondary">
                                                                                    Qté : {{ $sale->quantity }}
                                                                                </span>
                                                                            </h5>
                                                                            <h5 class="font-weight-bold mt-2">
                                                                                <span class="badge bg-light"
                                                                                    style="color:black">
                                                                                    Prix : {{ $sale->price }} $
                                                                                </span>
                                                                            </h5>
                                                                            <h5 class="font-weight-bold mt-2">
                                                                                <span class="badge bg-light"
                                                                                    style="color:black">
                                                                                    Total : {{ $sale->total }} $
                                                                                </span>
                                                                            </h5>
                                                                            <h5 class="font-weight-bold mt-2">
                                                                                <span class="badge bg-light"
                                                                                    style="color:black">
                                                                                    Reste : {{ $sale->change }} $
                                                                                </span>
                                                                            </h5>
                                                                            <h5 class="font-weight-bold mt-2">
                                                                                <span class="badge bg-light"
                                                                                    style="color:black">
                                                                                    Type de paiement :
                                                                                    {{ $sale->payment_type === 'cash' ? 'Espéce' : 'Carte bancaire' }}
                                                                                </span>
                                                                            </h5>
                                                                            <h5 class="font-weight-bold mt-2">
                                                                                <span class="badge bg-light"
                                                                                    style="color:black">
                                                                                    Etat de paiement :
                                                                                    {{ $sale->payment_status === 'paid' ? 'Payé' : 'Impayé' }}
                                                                                </span>
                                                                            </h5>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-2 d-flex justify-content-center">
                                                                    <a href="{{ route('sales.edit', $sale->id) }}"
                                                                        class="btn btn-sm btn-warning m-2">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    <a href="#" target="_blank"
                                                                        class="btn btn-sm btn-primary m-2 "
                                                                        onclick="print({{ $sale->id }})">
                                                                        <i class="fas fa-print"></i>
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        @endforeach


                                                    </div>
                                                </div>



                                                {{-- @endif --}}
                                            @endforeach
                                        </div>

                                    </div>
                                    <h5 class="m-3"> Menus</h5>
                                    <div class="row justify-content-center">
                                        <div class="col-md-12 card p-3">
                                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                @foreach ($categories as $category)
                                                    <li class="nav-item">
                                                        <a class="nav-link mr-1 {{ $category->slug === 'samaki' ? 'active' : '' }}"
                                                            data-toggle="pill" id="{{ $category->slug }}-tab"
                                                            href="#{{ $category->slug }}" role="tab"
                                                            aria-controls="{{ $category->slug }}" aria-selected="true">
                                                            {{ $category->title }}

                                                        </a>
                                                        {{-- <a href="#{{ $category->slug }}"
                                                            class="nav-link mr-1 {{ $category->slug === 'samaki' ? 'active' : '' }}"
                                                            id="{{ $category->slug }}-tab" data-toggle="pill" role="tab"
                                                            aria-controls="{{ $category->slug }}" aria-selected="true">
                                                            {{ $category->title }}
                                                        </a> --}}
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="tab-content" id="pills-tabcontent">
                                                @foreach ($categories as $category)
                                                    <div class="tab-pane fade {{ $category->slug === 'samaki' ? 'show active' : '' }}"
                                                        id="{{ $category->slug }}" role="tabpanel"
                                                        aria-labelledby="pills-home-tab">
                                                        <div class="row">
                                                            @foreach ($category->menus as $menu)
                                                                <div class="col-md-4 mb-2">
                                                                    <div class="card h-100">
                                                                        <div
                                                                            class="card-body d-flex
                                                                                flex-column justify-content-center
                                                                                align-items-center">
                                                                            <div class="align-self-end mb-2">
                                                                                <input type="checkbox" name="menu_id[]"
                                                                                    id="menu_id"
                                                                                    value="{{ $menu->id }}">
                                                                            </div>
                                                                            <img src="{{ asset('images/menus/' . $menu->image) }}"
                                                                                alt="{{ $menu->title }}"
                                                                                class="img-fluid rounded-circle"
                                                                                width="100" height="100">
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
                                                        </div>


                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mx-auto">
                                                    <div class="form-group mb-2">
                                                        <select name="servant_id" class="form-control">
                                                            <option value="" selected disabled>
                                                                Sérveur
                                                            </option>
                                                            @foreach ($servants as $servant)
                                                                <option value="{{ $servant->id }}">
                                                                    {{ $servant->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                Qté
                                                            </div>
                                                        </div>
                                                        <input type="number" name="quantity" class="form-control"
                                                            placeholder="Qté">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                $
                                                            </div>
                                                        </div>
                                                        <input type="number" name="price" class="form-control"
                                                            placeholder="Prix">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                .00
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                $
                                                            </div>
                                                        </div>
                                                        <input type="number" name="total" class="form-control"
                                                            placeholder="Total">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                .00
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                $
                                                            </div>
                                                        </div>
                                                        <input type="number" name="change" class="form-control"
                                                            placeholder="Reste">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                .00
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <select name="payment_type" class="form-control">
                                                            <option value="" selected disabled>
                                                                Type de paiement
                                                            </option>
                                                            <option value="cash">
                                                                Espéce
                                                            </option>
                                                            <option value="card">
                                                                Carte bancaire
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <select name="payment_status" class="form-control">
                                                            <option value="" selected disabled>
                                                                Etat de paiement
                                                            </option>
                                                            <option value="paid">
                                                                Payé
                                                            </option>
                                                            <option value="unpaid">
                                                                Impayé
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <button
                                                            onclick="event.preventDefault();
                                                                document.getElementById('add-sale').submit();"class="btn btn-primary">
                                                            Valider
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>






                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>

    </div>
@endsection

@section('javascript')
    <script>
        function print(el) {
            const page = document.body.innerHTML;
            const content = document.getElementById(el).innerHTML;
            document.body.innerHTML = content;
            window.print();
            document.body.innerHTML = page;
        }
    </script>
@endsection
