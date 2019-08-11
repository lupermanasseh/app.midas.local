<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Make  a new policy
        $this->registerMidasPolicies();

        //

    }

    //Midas policies
    public function registerMidasPolicies(){
        Gate::define('create',function($user){
           return $user->hasAccess(['create']);
        });

        Gate::define('read',function($user){
           return $user->hasAccess(['read']);
        });

        Gate::define('update',function($user){
           return $user->hasAccess(['update']);
        });

        Gate::define('partial',function($user){
           return $user->hasAccess(['partial']);
        });

        Gate::define('all',function($user){
           return $user->inRole('accounts');
        });

        // Gate::define('review',function($user, \App\Post $post){
        //     $user->hasAccess(['review']) or $user->id ==$post->user_id;
        // });
   
    }
}
