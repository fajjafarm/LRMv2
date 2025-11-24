<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Exceptions\IncompletePayment;

class BillingController extends Controller
{
    public function show()
    {
        $business = auth()->user()->business;
        return view('billing.show', compact('business'));
    }

    public function upgrade(Request $request)
    {
        $business = auth()->user()->business;
        $modules = $request->input('modules', []);

        try {
            $business->enabled_modules = array_unique(array_merge($business->enabled_modules, $modules));
            $business->save();

            $business->newSubscription('default', 'price_custom_'.$business->id)
                     ->withMetadata(['modules' => $modules])
                     ->create($request->payment_method);

            return back()->with('success', 'Plan upgraded successfully!');
        } catch (IncompletePayment $e) {
            return redirect()->route('cashier.payment', $e->payment->id);
        }
    }
}