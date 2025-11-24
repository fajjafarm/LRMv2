<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()?->is_super_admin) abort(403);
            return $next($request);
        });
    }

    public function createBusiness()
    {
        return view('superadmin.create-business');
    }

    public function storeBusiness(Request $request)
    {
        $business = Business::create($request->only(['name', 'monthly_price', 'enabled_modules']));
        return redirect()->route('dashboard')->with('success', 'Business created');
    }
}