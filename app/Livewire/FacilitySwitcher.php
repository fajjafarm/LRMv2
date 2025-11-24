<?php

namespace App\Livewire;

use Livewire\Component;

class FacilitySwitcher extends Component
{
    public function render()
    {
        $facilities = auth()->user()->business?->facilities ?? collect();

        return view('livewire.facility-switcher', [
            'facilities' => $facilities,
            'current' => auth()->user()->currentFacility,
        ]);
    }
}