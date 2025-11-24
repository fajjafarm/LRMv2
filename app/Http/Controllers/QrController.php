<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrController extends Controller
{
    public function redirect($type, $id)
    {
        $model = $type::findOrFail($id);

        return match($type) {
            'App\Models\SubFacility' => redirect()->route('pool.test.form', $model),
            'App\Models\Filter' => redirect()->route('filters.backwash', $model),
            'App\Models\Equipment' => redirect()->route('equipment.show', $model),
            default => redirect()->route('dashboard')
        };
    }
}