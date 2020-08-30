<?php

namespace App\Policies;

use App\Leave;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeavePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function leave_access(User $user, Leave $leave) {
        return $user->employee->id === $leave->employee_id;
    }
}
