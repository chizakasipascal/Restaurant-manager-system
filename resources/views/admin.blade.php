@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}

                    <div class="card-body">
                        {{-- @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }} --}}

                        <div class="row">
                            <div class="col-sm-4 d-flex flex-column align-items-center justify-items-center">
                                <i class="fa fa-cog fa-4x text-success"></i>

                                <a href="{{ route('categories.index') }}" class="btn btn-link font-weight-bold">
                                    Gérer
                                </a>
                            </div>
                            <div class="col-sm-4 d-flex flex-column align-items-center justify-items-center">
                                <i class="fa fa-shopping-cart fa-4x text-danger"></i>
                                <a href="{{ route('sales.create') }}" class="btn btn-link font-weight-bold">
                                    Ventes
                                </a>
                            </div>
                            <div class="col-sm-4 d-flex flex-column align-items-center justify-items-center">
                                <i class="fa fa-chart-bar fa-4x text-primary"></i>
                                <a href="{{ route('reports.index') }}" class="btn btn-link font-weight-bold">
                                    Rapports
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
