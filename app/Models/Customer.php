// 021 app/Models/Customer.php (Cashier)
<?php

namespace App\Models;

use Laravel\Cashier\Billable;

class Customer extends \Illuminate\Database\Eloquent\Model
{
    use Billable;

    protected $fillable = ['billable_id', 'billable_type', 'stripe_id', 'pm_type', 'pm_last_four', 'trial_ends_at'];

    public function billable()
    {
        return $this->morphTo();
    }
}