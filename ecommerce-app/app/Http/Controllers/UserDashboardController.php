<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard'); // Crée la vue resources/views/user/dashboard.blade.php
    }
}
