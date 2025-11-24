// 004 app/Http/Controllers/Api/AiRecommendationController.php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AiRecommendation;

class AiRecommendationController extends Controller
{
    public function index()
    {
        $recs = AiRecommendation::where('facility_id', auth()->user()->current_facility_id)
            ->active()
            ->orderBy('priority', 'desc')
            ->get();

        return response()->json($recs);
    }

    public function dismiss(AiRecommendation $recommendation)
    {
        $recommendation->update([
            'dismissed' => true,
            'dismissed_at' => now()
        ]);

        return response()->json(['message' => 'Dismissed']);
    }
}