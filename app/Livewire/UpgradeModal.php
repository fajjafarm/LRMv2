<?php

namespace App\Livewire\Billing;

use Livewire\Component;

class UpgradeModal extends Component
{
    public $show = false;

    public function render()
    {
        return view('livewire.billing.upgrade-modal');
    }
}