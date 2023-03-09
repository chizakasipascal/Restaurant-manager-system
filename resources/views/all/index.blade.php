@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card-body">
                    <h5 class="m-3"> Menus</h5>
                    <div class="row justify-content-center">
                        <div class="col-md-12 card p-3">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                @foreach ($categories as $category)
                                    <li class="nav-item">
                                        <a class="nav-link mr-1 {{ $category->slug === 'diner' ? 'active' : '' }}"
                                            data-toggle="pill" id="{{ $category->slug }}-tab" href="#{{ $category->slug }}"
                                            role="tab" aria-controls="{{ $category->slug }}" aria-selected="true">
                                            {{ $category->title }}

                                        </a>

                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content" id="pills-tabcontent">
                                @foreach ($categories as $category)
                                    <div class="tab-pane fade {{ $category->slug === 'diner' ? 'show active' : '' }}"
                                        id="{{ $category->slug }}" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <div class="row">
                                            @foreach ($category->menus as $menu)
                                                {{-- <div class="col-md-4 mb-2">
                                                    <div class="card h-100">
                                                        <div
                                                            class="card-body d-flex
                                                                                flex-column justify-content-center
                                                                                align-items-center">
                                                            <div class="align-self-end mb-2">
                                                                <input type="checkbox" name="menu_id[]" id="menu_id"
                                                                    value="{{ $menu->id }}">
                                                            </div>
                                                            <img src="{{ asset('images/menus/' . $menu->image) }}"
                                                                alt="{{ $menu->title }}" class="img-fluid rounded-circle"
                                                                width="100" height="100">
                                                            <h5 class="font-weight-bold mt-2">
                                                                {{ $menu->title }}
                                                            </h5>
                                                            <h5 class="text-muted">
                                                                {{ $menu->price }} $
                                                            </h5>

                                                            <h5 class="text-muted">
                                                                {{ $menu->description }}
                                                            </h5>


                                                        </div>
                                                    </div>
                                                </div> --}}

                                                <div class="card  m-2" style="width: 18rem; ">


                                                    <img src="{{ asset('images/menus/' . $menu->image) }}" class="img-fluid"
                                                        alt="...">
                                                    {{-- Get element checkbx --}}
                                                    {{-- <div class="align-self-end mb-2">
                                                        <input type="checkbox" name="menu_id[]" id="menu_id"
                                                            value="{{ $menu->id }}">
                                                    </div> --}}
                                                    <div class="card-body">

                                                        <h5 class="card-title"> {{ $menu->title }}</h5>
                                                        <h5 class="card-title"> {{ $menu->price }}fc</h5>
                                                        <p class="card-title"> {{ $menu->description }}
                                                        </p>

                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
