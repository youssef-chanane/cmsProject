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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::resource('category','App\Policies\CategoryPolicy');
        // Gate::define("category.update",function($user,$category){
        //     return $user->id===$category->user_id;
        // });
        // Gate::define("category.delete",function($user,$category){
        //     return $user->id===$category->user_id;
        // });
        Gate::before(function($user,$ability){
            if($user->is_admin && in_array($ability,['category.update'])){
                return true;
            }
        });
    }
}
