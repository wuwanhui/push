<?php

namespace App\Providers;

use App\Models\Enterprise;
use App\Models\User;
use App\Policies\EnterprisePolicy;
use App\Policies\OverallPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        User::class => OverallPolicy::class,
        Enterprise::class => EnterprisePolicy::class,
    ];


    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

//        Passport::tokensExpireIn(Carbon::now()->addDays(15));
//
//        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
    }
}
