<?php

namespace App\Http\Controllers;
use App\Services\Contracts\PaymentServiceInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected PaymentServiceInterface $paymentService;

    public function __construct(PaymentServiceInterface $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric',
            'payment_method' => 'required|in:card,cash',
            'payment_status' => 'required|in:paid,unpaid',
            'paid_at' => 'nullable|date',
        ]);

        $payment = $this->paymentService->processPayment($validated);
        return response()->json($payment, 201);
    }
}
