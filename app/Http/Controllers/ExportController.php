<?php

namespace App\Http\Controllers;

use App\Exports\PoolTestsExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function poolTests()
    {
        return Excel::download(new PoolTestsExport, 'pool-tests-'.now()->format('Y-m-d').'.xlsx');
    }
}