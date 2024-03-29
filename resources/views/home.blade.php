@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}

                        @can('isAdmin')
                            @include('admin')
                        @endcan

                        @can('isGerant')
                            @include('gerant')
                        @endcan

                        @can('isServeur')
                            @include('serveur')
                        @endcan

                        @can('isClient')
                            @include('client')
                        @endcan

                        @can('isBlock')
                            @include('block')
                        @endcan

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
