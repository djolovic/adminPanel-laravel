<?php

namespace App\Services;

use App\Models\User;
use App\Services\Interfaces\ReportServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserService implements ReportServiceInterface
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {

        $this->user = $user;
    }

    public function thisWeekToLastWeekIncrease(): float
    {
        $lastWeek = $this->user->where(
            DB::raw('WEEKOFYEAR(created_at)'),
            Carbon::now()->subWeek(1)->weekOfYear
        )->count()
        ;

        $thisWeek = $this->user->where(DB::raw('WEEKOFYEAR(created_at)'), Carbon::now()->weekOfYear)
            ->count()
        ;

        if (($lastWeek === 0) && ($thisWeek === 0)) {
            return 0;
        }

        return (($lastWeek === 0 && $thisWeek !== 0 ? ($thisWeek * 100)
            : ($thisWeek / $lastWeek) * 100));
    }
}
