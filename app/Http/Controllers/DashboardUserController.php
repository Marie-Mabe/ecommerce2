<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    public function index()
    {
        return view('DashboardUser'); // Correspond à resources/views/home.blade.php
    }
}
