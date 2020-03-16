<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;

class AuthUserController extends Controller
{
    public function show(){
        return new UserResource(auth()->user());
    }
}
