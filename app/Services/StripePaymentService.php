<?php

namespace App\Services;

use App\Models\StripePayment;
use App\Models\User;
use App\Services\Interfaces\PaymentReportInterface;
use App\Services\Interfaces\ReportServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StripePaymentService implements PaymentReportInterface
{
    /**
     * @var StripePayment
     */
    private $stripePayment;

    public function __construct(StripePayment $stripePayment)
    {

        $this->stripePayment = $stripePayment;
    }

    public function totalPayment(): float
    {
        return $this->stripePayment->sum('amount') * 0.01;
    }

    public function thisWeekToLastWeekPaymentIncrease(): float
    {
        $stripePaymentLastWeek = $this->stripePayment->where(
                DB::raw('WEEKOFYEAR(created_at)'),
                Carbon::now()->subWeek(1)->weekOfYear
            )->sum('amount');

        $stripePaymentThisWeek = $this->stripePayment->where(
                DB::raw('WEEKOFYEAR(created_at)'),
                Carbon::now()->weekOfYear
            )->sum('amount');

        if (($stripePaymentLastWeek === 0) && ($stripePaymentThisWeek === 0)) {
            return 0;
        }

        return (($stripePaymentLastWeek === 0 && $stripePaymentThisWeek !== 0
            ? ($stripePaymentThisWeek * 0.01)
            : ($stripePaymentThisWeek / $stripePaymentLastWeek) * 0.01));
    }
}
