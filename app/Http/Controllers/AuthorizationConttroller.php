<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;


class AuthorizationConttroller extends Controller
{
     public function index(){
        Gate::allows('isAdmin')?Response::allow():abort(403);
        return view('admin');
    }
}
