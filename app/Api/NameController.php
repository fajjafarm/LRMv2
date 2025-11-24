<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RecurringServiceSchedule;
use App\Http\Resources\RecurringServiceScheduleResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecurringServiceScheduleController extends Controller
{
    public function index()
    {
        $schedules = Auth::user()->business->recurringServiceSchedules()
            ->with('schedulable')
            ->latest()
            ->get();

        return RecurringServiceScheduleResource::collection($schedules);
    }

    public function logCompletion(Request $request, RecurringServiceSchedule $schedule)
    {
        $request->validate(['notes' => 'nullable|string']);

        $log = $schedule->logCompletion(Auth::user(), $request->notes);

        return response()->json([
            'message' => 'Service logged',
            'next_due' => $schedule->fresh()->next_due_date
        ]);
    }
}