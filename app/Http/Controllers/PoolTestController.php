<?php

namespace App\Http\Controllers;

use App\Models\SubFacility;
use App\Models\PoolTest;
use Illuminate\Http\Request;

class PoolTestController extends Controller
{
    public function create(SubFacility $subFacility)
    {
        return view('pool.test.create', compact('subFacility'));
    }

    public function store(Request $request, SubFacility $subFacility)
    {
        $validated = $request->validate([
            'temperature' => 'required|numeric|min:20|max:40',
            'free_chlorine' => 'required|numeric|min:0|max:10',
            'ph' => 'required|numeric|min:6.8|max:7.8',
            'notes' => 'nullable|string',
        ]);

        $test = PoolTest::create([
            'sub_facility_id' => $subFacility->id,
            'performed_by' => auth()->id(),
            'tested_at' => now(),
            ...$validated
        ]);

        if ($test->isOutOfRange()) {
            Task::create([
                'business_id' => auth()->user()->business_id,
                'facility_id' => $subFacility->facility_id,
                'sub_facility_id' => $subFacility->id,
                'title' => 'URGENT: Water Chemistry Out of Range',
                'description' => "pH: {$test->ph}, Free Chlorine: {$test->free_chlorine}",
                'priority' => 'critical',
                'created_by' => auth()->id(),
                'is_automated' => true,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Pool test recorded!');
    }
}