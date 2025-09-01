<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = Auth::user();

        return view('admin.dashboard', [
            'admin' => $admin,
        ]);
    }
}