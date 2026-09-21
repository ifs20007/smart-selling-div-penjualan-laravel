<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Memanggil file resources/views/dashboard.blade.php
        return view('dashboard');
    }
}