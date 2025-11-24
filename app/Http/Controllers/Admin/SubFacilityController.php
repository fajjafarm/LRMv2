<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class SubFacilityController extends Controller
{
    public function create(Facility $facility)
    {
        return view('admin.sub-facilities.create', compact('facility'));
    }

    public function store(Request $request, Facility $facility)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'check_interval_minutes' => 'nullable|integer',
        ]);

        $facility->subFacilities()->create($request->all());

        return redirect()->back()->with('success', 'Sub-facility created!');
    }
}