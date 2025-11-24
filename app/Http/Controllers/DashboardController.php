<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->is_super_admin) {
            return view('superadmin.dashboard');
        }

        if (!$user->current_facility_id) {
            return redirect()->route('business.overview');
        }

        return view('dashboard');
    }
}