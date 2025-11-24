// app/Services/ComplianceCalculator.php
<?php

namespace App\Services;

use App\Models\Facility;
use App\Models\ComplianceScore;
use Carbon\Carbon;

class ComplianceCalculator
{
    public function calculateForFacility(Facility $facility, ?Carbon $date = null)
    {
        $date = $date ?? today();

        $checks = [
            'pool_tests' => $this->poolTestScore($facility, $date),
            'training'   => $this->trainingScore($facility, $date),
            'service'    => $this->serviceScore($facility, $date),
            'coshh'     => $this->coshhScore($facility),
            'documents'  => $this->documentsScore($facility),
        ];

        $total = array_sum($checks);
        $score = (int) round($total / count($checks));

        ComplianceScore::updateOrCreate(
            ['facility_id' => $facility->id, 'date' => $date],
            [
                'business_id' => $facility->business_id,
                'score' => $score,
                'breakdown' => $checks,
                'total_checks' => count($checks),
                'passed_checks' => count(array_filter($checks, fn($v) => $v >= 90)),
            ]
        );

        return $score;
    }

    private function poolTestScore(Facility $facility, Carbon $date): int
    {
        $required = $facility->subFacilities->sum('check_interval_minutes') > 0 ? 96 : 0; // ~every 15 mins
        $actual = $facility->poolTests()->whereDate('tested_at', $date)->count();
        return $required > 0 ? min(100, (int)round(($actual / $required) * 100)) : 100;
    }

    private function trainingScore(Facility $facility, Carbon $date): int
    {
        $staff = $facility->users()->with('qualifications')->get();
        $compliant = $staff->filter(fn($u) => $u->isTrainingCompliant())->count();
        return $staff->count() > 0 ? (int)round(($compliant / $staff->count()) * 100) : 100;
    }

    private function serviceScore(Facility $facility, Carbon $date): int
    {
        $overdue = $facility->equipment()->whereHas('serviceSchedules', fn($q) => $q->overdue())->count();
        $total = $facility->equipment()->where('requires_maintenance', true)->count();
        return $total > 0 ? 100 - min(100, (int)round(($overdue / $total) * 100)) : 100;
    }

    private function coshhScore(Facility $facility): int
    {
        $missingMsds = $facility->business->chemicals()->whereDoesntHave('coshh')->count();
        $total = $facility->business->chemicals()->count();
        return $total > 0 ? 100 - min(100, (int)round(($missingMsds / $total) * 100)) : 100;
    }

    private function documentsScore(Facility $facility): int
    {
        $required = ['NOP', 'EAP', 'Risk Assessment'];
        $current = $facility->documents()->whereIn('type', $required)->where('valid_until', '>', now())->count();
        return (int)round(($current / count($required)) * 100);
    }
}