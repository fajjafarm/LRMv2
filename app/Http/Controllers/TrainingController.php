<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function compliance()
    {
        $users = User::with('qualifications')->get();
        return view('training.compliance', compact('users'));
    }
}