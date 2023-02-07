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
                                    <div class="col-md-12">
                                        {{ Carbon\Carbon::now() }}
                                    </div>
                                </h3>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach ($tables as $table)
                                                {{-- {{ $table }} --}}

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
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                    // Menus
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
                                                                                {{ $menu->price }} DH
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
