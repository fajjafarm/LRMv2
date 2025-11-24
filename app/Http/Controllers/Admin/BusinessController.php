<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;

class BusinessController extends Controller
{
    public function index()
    {
        $businesses = Business::withCount('facilities')->paginate(20);
        return view('superadmin.businesses', compact('businesses'));
    }
}