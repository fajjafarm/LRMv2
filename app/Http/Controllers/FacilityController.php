<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function switch(Facility $facility)
    {
        $this->authorize('view', $facility);

        auth()->user()->update(['current_facility_id' => $facility->id]);

        return redirect()->route('dashboard')->with('success', 'Switched to ' . $facility->name);
    }

    public function overview()
    {
        $facilities = auth()->user()->business->facilities()->withCount('subFacilities')->get();
        return view('facility.overview', compact('facilities'));
    }
}