<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\LifeguardClockIn;

class LifeguardController extends Controller
{
    public function clockin(Facility $facility)
    {
        $existing = LifeguardClockIn::where('user_id', auth()->id())
            ->whereNull('clock_out_at')
            ->first();

        if ($existing) {
            $existing->update([
                'clock_out_at' => now(),
                'hours_worked' => $existing->clock_in_at->diffInHours(now()),
            ]);
            return redirect()->route('lifeguard.portal', $facility)->with('clocked_out', true);
        }

        LifeguardClockIn::create([
            'user_id' => auth()->id(),
            'facility_id' => $facility->id,
            'clock_in_at' => now(),
        ]);

        return redirect()->route('lifeguard.portal', $facility)->with('success', true);
    }

    public function portal(Facility $facility)
    {
        return view('lifeguard.portal', compact('facility'));
    }
}