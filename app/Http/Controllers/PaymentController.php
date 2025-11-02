<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Show payment options for a property (dummy).
     */
    public function options(Property $property)
    {
        return view('payments.options', compact('property'));
    }

    /**
     * Handle cash-at-homestay selection (dummy) and redirect to success page.
     */
    public function cash(Request $request)
    {
        // In a real app you'd create a booking/reservation here.
        // For the dummy flow we just redirect to a success page.

        return redirect()->route('payments.success')->with('message', 'Payment will be made as Cash at homestay.');
    }

    /**
     * Show success page which will auto-redirect to home.
     */
    public function success()
    {
        return view('payments.success');
    }
}
