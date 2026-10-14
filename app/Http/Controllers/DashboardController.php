<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        // Memanggil file resources/views/dashboard.blade.php
        return view('dashboard');
    }
}
