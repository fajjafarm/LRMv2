<?php

namespace App\Http\Controllers;

use App\Imports\PalintestImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function palintest(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
            'sub_facility_id' => 'required|exists:sub_facilities,id'
        ]);

        Excel::import(new PalintestImport($request->sub_facility_id), $request->file('file'));

        return back()->with('success', 'Palintest data imported!');
    }
}