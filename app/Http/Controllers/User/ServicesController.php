<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
    public function index()
    {
        return view('user.service');
    }
}