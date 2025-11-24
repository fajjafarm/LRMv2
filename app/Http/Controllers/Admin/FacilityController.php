<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function create(Business $business)
    {
        return view('admin.facilities.create', compact('business'));
    }

    public function store(Request $request, Business $business)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $business->facilities()->create([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
        ]);

        return redirect()->route('admin.businesses.index')
            ->with('success', 'Facility created!');
    }
}