<?php

use App\Models\Payment;
use App\Services\Contracts\PaymentServiceInterface;

class PaymentService implements PaymentServiceInterface
{
    public function processPayment(array $data): Payment
    {
        return Payment::create($data);
    }
}
