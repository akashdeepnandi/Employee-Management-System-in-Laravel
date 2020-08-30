<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Gate for admin
        Gate::define('admin-access', function($user){
            return $user->hasRole('admin');
        });
        // Gate for employee
        Gate::define('employee-access', function($user){
            return $user->hasRole('employee');
        });

        Gate::define('employee-expenses-access', 'App\Policies\ExpensePolicy@expense_access');
        Gate::define('employee-leaves-access', 'App\Policies\LeavePolicy@leave_access');
        Gate::define('employee-profile-access', 'App\Policies\EmployeePolicy@isOwner');
    }
}
