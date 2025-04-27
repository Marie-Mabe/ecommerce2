<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{

    public function index()
    {
        return view('admin.dashboard'); // Crée la vue resources/views/admin/dashboard.blade.php
    }
}
