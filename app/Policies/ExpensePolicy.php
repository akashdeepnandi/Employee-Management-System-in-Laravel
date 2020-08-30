<?php

namespace App\Policies;

use App\Expense;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ExpensePolicy
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

    public function expense_access(User $user, Expense $expense) {
        return $user->employee->id === $expense->employee_id;
    }
}
