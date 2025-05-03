<?php

namespace App\Services\Contracts;
use App\Models\Payment;
interface PaymentServiceInterface
{
    public function processPayment(array $data): Payment;
}
