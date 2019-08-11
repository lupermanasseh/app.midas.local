<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Product;
use App\Loan;
use App\Role;
use App\User;
use App\Lsubscription;
use App\Saving;
use App\TargetSaving;
use App\Productdivision;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        
        //view composer for product list
        view()->composer(['ProductSub.create','ProductSub.editSubscription'], function($view){
            $view->with('prodList', Product::productList());
        });

        //view composer for loan product list
        view()->composer(['LoanSub.create','LoanSub.editLoanSub','LoanSub.newLoan'], function($view){
            $view->with('loanProd', Loan::loanProducts());
        });

        //product items view composer
        view()->composer(['Products.newProduct','Products.editProducts','ProductSub.create','LoanSub.create','LoanSub.editLoanSub'], function($view){
            $view->with('catlist', Productdivision::productCatList());
        });

          //view composer for new user
          view()->composer(['Registration.newUser','Users.editProfile'], function($view){
            $view->with('roles', Role::allRoles());
        });
        
        //TODO
        /**
         * Create view composer for user dashboard
         */
        view()->composer('inc.dashboard-overview', function($view){
            $view->with('totalSaving', Saving::mySavings(auth()->id()));
        });

        view()->composer('inc.dashboard-overview', function($view){
            $view->with('tsSaving', TargetSaving::myTargetSavings(auth()->id()));
        });

        view()->composer('inc.dashboard-userreviews', function($view){
            $view->with('paid', Lsubscription::paidLoans(auth()->id()));
        });

        view()->composer('inc.dashboard-userreviews', function($view){
            $view->with('myPendingApp', Lsubscription::pendingLoans(auth()->id()));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        
    }
}
