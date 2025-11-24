<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(Business $business)
    {
        return view('admin.users.create', compact('business'));
    }

    public function store(Request $request, Business $business)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'business_id' => $business->id,
        ]);

        return redirect()->route('admin.businesses.index')
            ->with('success', "User {$user->name} added to {$business->name}!");
    }
}