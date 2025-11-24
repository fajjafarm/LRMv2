<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PoolTest;
use Illuminate\Http\Request;

class PoolTestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sub_facility_id' => 'required|exists:sub_facilities,id',
            'temperature' => 'required|numeric',
            'free_chlorine' => 'required|numeric',
            'ph' => 'required|numeric',
        ]);

        $test = PoolTest::create([
            'sub_facility_id' => $validated['sub_facility_id'],
            'performed_by' => auth()->id(),
            'tested_at' => now(),
            ...$validated
        ]);

        return response()->json(['message' => 'Test recorded', 'out_of_range' => $test->isOutOfRange()]);
    }
}