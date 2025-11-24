<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DynamicSidebar extends Component
{
    public function render()
    {
        $user = Auth::user();
        $hasFacility = $user->current_facility_id ? true : false;

        return view('livewire.dynamic-sidebar', [
            'user' => $user,
            'hasFacility' => $hasFacility,
        ]);
    }
}