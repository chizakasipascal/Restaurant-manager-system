@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                @include('layouts.sidebar')

                            </div>
                            <div class="col-md-8">
                                <h3 class="text-secondary border-bottom mb-3 p-2">
                                    <i class="fas fa-plus"></i> Modifier les information lieu a l'uttlisateur
                                    {{ Str::ucfirst($agent->name) }}
                                </h3>
                                <form action="{{ route('agent.update', $agent->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group mb-2">
                                        <input type="hidden" name="id" id="id" class="form-control"
                                            placeholder="Nom & Prénom" value="{{ $agent->id }}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Nom & Prénom" value="{{ $agent->name }}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="text" name="email" id="email" class="form-control"
                                            placeholder="Email" value="{{ $agent->email }}">
                                    </div>
                                    {{-- <div class="form-group mb-2">
                                        <input type="text" name="role" id="role" class="form-control"
                                            placeholder="Role" value="{{ $agent->role }}">
                                    </div> --}}

                                    <div class="form-group mb-2">
                                        <label for="title">Select role:</label>
                                        <select name="role" id="role" class="form-control">
                                            <option value="block">Select role</option>
                                            <option value="admin">Admin</option>
                                            <option value="gerant">Gerant</option>
                                            <option value="serveur">Serveur</option>
                                            <option value="client">Client</option>
                                            <option value="block">Block</option>

                                        </select>
                                    </div>

                                    <div class="form-group mb-2">
                                        <button class="btn btn-primary">
                                            Valider
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
