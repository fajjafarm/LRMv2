<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\AuditReport;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class AuditReportController extends Controller
{
    public function generate(Facility $facility)
    {
        $this->authorize('view', $facility);

        $pdf = Pdf::loadView('pdf.hse-audit', compact('facility'))
            ->setPaper('a4');

        $filename = 'HSE_AUDIT_' . $facility->slug . '_' . now()->format('Y-m-d_His') . '.pdf';
        $path = 'audit-reports/' . $filename;

        \Storage::put($path, $pdf->output());

        $qr = QrCode::format('png')->size(300)->generate(route('audit.verify', $facility->id));
        $qrPath = 'audit-qr/' . Str::random(40) . '.png';
        \Storage::put($qrPath, $qr);

        AuditReport::create([
            'facility_id' => $facility->id,
            'generated_by' => auth()->id(),
            'file_path' => $path,
            'qr_code_path' => $qrPath,
        ]);

        return back()->with('success', 'HSE Audit Report Generated!');
    }
}