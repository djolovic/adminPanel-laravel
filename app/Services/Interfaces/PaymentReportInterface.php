<?php
namespace App\Services\Interfaces;

interface PaymentReportInterface
{
    public function totalPayment(): float;

    public function thisWeekToLastWeekPaymentIncrease(): float;
}
