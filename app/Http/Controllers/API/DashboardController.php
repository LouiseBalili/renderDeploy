<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return inertia('Dashboard');
    }
}
