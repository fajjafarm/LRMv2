<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceLog;
use Illuminate\Http\Request;

class ServiceLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = ServiceLog::whereHas('schedule', fn($q) => 
            $q->where('business_id', auth()->user()->business_id)
        )
        ->with(['performedBy', 'schedule.schedulable'])
        ->when($request->overdue, fn($q) => $q->where('was_overdue', true))
        ->latest()
        ->paginate(50);

        return response()->json($logs);
    }
}