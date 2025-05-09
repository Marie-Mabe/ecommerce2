<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index()
    {
        return view('user.shop');
    }
}