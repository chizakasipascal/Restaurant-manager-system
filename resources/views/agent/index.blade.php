@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    {{-- <th>Id</th> --}}
                                    <th>Nom & Prénom</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agent as $user)
                                    <tr>
                                        {{-- <td>
                                            {{ $user->id }}
                                        </td> --}}
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            {{ $user->role }}
                                        </td>


                                        <td class="d-flex flex-row justify-content-center align-items-center ">
                                            <a href="{{ route('agent.edit', $user->id) }}"class="btn btn-warning mr-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form id="{{ $user->id }}" action="#" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    onclick="
                                                                event.preventDefault();
                                                                if(confirm('Voulez vous supprimer le sérveur {{ $user->name }} ?'))
                                                                document.getElementById({{ $user->id }}).submit()
                                                            "
                                                    class="btn btn-danger m-2">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
