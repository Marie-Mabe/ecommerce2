<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        return view('user.contact');
    }
}