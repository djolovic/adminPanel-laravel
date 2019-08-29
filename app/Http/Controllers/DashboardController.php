<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDashboard(
        User $user,
        UserService $userService,
        Payment $paymentService
    ) {

        return view(
            'dashboards.main'
            ,
            [
                'totalUsers' =>$user->count(),
                'totalUserIncrease'=>$userService->thisWeekToLastWeekIncrease()

            ]
        );
    }
}
