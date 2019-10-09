<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::prefix('admin')->group(function () {
//     Route::get('users', function () {
//         // Matches The "/admin/users" URL
//     });
// });

  //
    // Route::middleware(['auth'])->group(function () {
    //     Route::get('leadsadd','crmcontroller@addleads');
    //     Route::get('leadslist', 'crmcontroller@leadslist');
    //     Route::any('leadview/{id}','crmcontroller@show');
    //     Route::get('leadedit/{id}','crmcontroller@edit');
    // });

//ROUTES FOR HOME CONTROLLER
Route::get('/', 'HomeController@index');
Route::get('/about', 'HomeController@about');
Route::get('/committee', 'HomeController@committee'); 
Route::get('/board', 'HomeController@board');
Route::get('/products', 'HomeController@products');
Route::get('/news', 'HomeController@news');
Route::get('/gallery', 'HomeController@gallery');

//ROUTES FOR ADMIN DASHBOARD
Route::middleware(['auth'])->group(function () {
Route::get('/admin', 'MadminController@index');
});
/**
 * Client Dashboard Below
 * 
 */
Route::middleware(['auth'])->group(function () {
Route::get('/Dashboard/home','DashboardController@index');
Route::get('/Dashboard/user/savings','DashboardController@savings');
Route::get('/Dashboard/savings/{id}','DashboardController@savingsByYear');
Route::get('/Dashboard/user/savingsummary','DashboardController@savingsGroup');
Route::get('/Dashboard/user/targetsavings','DashboardController@targetSavingHome');
Route::get('/Dashboard/targetsavings/{id}','DashboardController@targetSavingListings');
Route::get('/Dashboard/user/allTargetsavings','DashboardController@allTargetSavings');
Route::post('/Dashboard/user/customsearch','DashboardController@customSearch');
Route::get('/Dashboard/user/loans','DashboardController@allLoans');
Route::get('/Dashboard/user/loans/{id}','DashboardController@loanDeductionHistory');
Route::get('/Dashboard/userloans/view/{id}','DashboardController@loanDetails');
Route::get('/Dashboard/user/schemes','DashboardController@allProducts');
Route::get('/Dashboard/userproducts/view/{id}','DashboardController@productDetails');
Route::get('/Dashboard/userproducts/history/{id}','DashboardController@productDeductionHistory');
Route::get('/Dashboard/print/{from}/{to}','DashboardController@printStatement');
Route::get('/Dashboard/downloadpdf/{from}/{to}','DashboardController@downloadStatement');
Route::get('/Dashboard/myPendingLoans/{id}','DashboardController@pendingApps');
Route::get('/Dashboard/myPaidLoans/{id}','DashboardController@paidLoans');
});

//REGISTRATION ROUTES
    Route::middleware(['auth'])->group(function () {
        Route::get('/New','RegistrationController@createUser');
        Route::post('/Create','RegistrationController@storeUser');
        Route::get('/Nok/{id}','RegistrationController@nextOfKin');
        Route::post('/nokStore','RegistrationController@nokStore');
        Route::get('/bank/{id}','RegistrationController@bank');
        Route::post('/bankStore','RegistrationController@bankStore');
        Route::get('/photo/{id}','RegistrationController@photoCreate');
        Route::post('/photoStore','RegistrationController@photoStore');
        Route::get('/saving/review/{id}','RegistrationController@createSaving');
        Route::post('/saving/review/store','RegistrationController@createSavingStore');
        Route::get('/saving/inactive/{id}','RegistrationController@deactivateSavingReview');
        Route::get('/filter/users','RegistrationController@filter');
        Route::post('/filter/users/process','RegistrationController@filterProcess');
        Route::get('/members/{status}/{end_date}/{cadre}','RegistrationController@membersDownload');
        Route::get('/users/upload','RegistrationController@uploadForm');
        Route::post('/users/upload/process','RegistrationController@membersUpload');
        Route::get('/nok/upload','RegistrationController@nokUploadForm');
        Route::post('/nok/upload/process','RegistrationController@nokBulkUpload');
        Route::get('/bank-bulk/upload','RegistrationController@bankUploadForm');
        Route::post('/bank/upload/process','RegistrationController@bankBulkUpload');
        Route::get('/saving-reg','RegistrationController@savingRegUploadForm');
        Route::post('/saving-reg/process','RegistrationController@savingRegUpload');
        Route::get('/ts-reg','RegistrationController@tsUploadForm'); //awaiting data
        Route::post('/ts-upload','RegistrationController@savingRegUpload'); //awaiting data

});

//Session/login controller
Route::get('/login', 'SessionController@create')->name('login');
Route::post('/signin','SessionController@store');
Route::get('/logout','SessionController@destroy');

//Manage Users  Controller
Route::middleware(['auth'])->group(function () {
Route::get('/user/all','UsersController@index');
Route::get('/user/bank','UsersController@bankList');
Route::get('/user/nok','UsersController@nokList');
Route::get('/userDetails/{id}','UsersController@profileDetails');
Route::get('/editProfile/{id}','UsersController@editProfile');
Route::post('/updateProfile/{id}','UsersController@updateProfile');
Route::get('/editBank/{id}','UsersController@editBank');
Route::post('/updateBank/{id}','UsersController@updateBank');
Route::get('/editNok/{id}','UsersController@editNok');
Route::post('/updateNok/{id}','UsersController@updateNok');
Route::get('/activateUser/{id}','UsersController@activateUser');
Route::get('/deactivateUser/{id}','UsersController@deactivateUser');
Route::post('/search/User','UsersController@searchUser');
Route::get('/change/password','UsersController@passwordChange');
Route::post('/password/store','UsersController@passwordStore');
});

//Product category routes
Route::middleware(['auth'])->group(function () {
Route::get('/product/category','ProductCategoryController@index');
Route::get('/product/category/add','ProductCategoryController@create');
Route::post('/product/category/store','ProductCategoryController@store');
Route::get('/product/category/edit/{id}','ProductCategoryController@edit');
Route::post('/product/category/update/{id}','ProductCategoryController@index');
Route::get('/category/items/{id}','ProductCategoryController@categoryItems');
});

//Products routes
Route::middleware(['auth'])->group(function () {
Route::get('/products','ProductsController@index');
Route::get('/deactivate/{id}','ProductsController@deactivate');
Route::get('/activate/{id}','ProductsController@activate');
Route::get('/product/create','ProductsController@create');
Route::post('/product/store','ProductsController@store');
Route::get('/product/detail/{id}','ProductsController@show');
Route::get('/editProduct/{id}','ProductsController@edit');
Route::post('/updateProduct/{id}','ProductsController@update');
Route::get('/product/items/{id}','ProductsController@getItems');
});


//Loan Subscription Routes
Route::middleware(['auth'])->group(function () {
Route::get('/loan-subscriptions','LoanSubscriptionController@index');
Route::get('/loanSub/create','LoanSubscriptionController@create');
Route::post('/loanSub/store','LoanSubscriptionController@store');
Route::get('/loan-request/{id}','LoanSubscriptionController@show'); 
Route::get('/loanSub/edit/{id}','LoanSubscriptionController@edit');
Route::get('/loanSub/stop/{id}','LoanSubscriptionController@loanStop');
Route::post('/loanSub/update/{id}','LoanSubscriptionController@update');
Route::get('/user/page/{id}','LoanSubscriptionController@userLoanSubscriptions');
Route::get('/userLoan/review/{id}','LoanSubscriptionController@review');
Route::post('/userLoan/reviewStore/{id}','LoanSubscriptionController@reviewStore');
Route::get('/pendingLoans','LoanSubscriptionController@pendingLoans');
Route::get('/activeLoans','LoanSubscriptionController@activeLoans');
Route::get('/activeLoan/detail/{id}','LoanSubscriptionController@loanDetails');
Route::get('/pendingApp/detail/{id}','LoanSubscriptionController@pendingAppDetail');
Route::get('/userLoan/discard/{id}','LoanSubscriptionController@destroy');
Route::get('/audited/loans','LoanSubscriptionController@auditedLoans');
Route::get('/approve/loans/{id}','LoanSubscriptionController@approveLoan');
Route::get('/approved/loans','LoanSubscriptionController@readyLoans');
Route::get('/pay/loan/{id}','LoanSubscriptionController@payLoan');
Route::post('/pay/store/{id}','LoanSubscriptionController@payStore');
Route::get('/loan/schedule/{id}','LoanSubscriptionController@loanSchedule');
Route::get('/loan/schedule/print/{id}','LoanSubscriptionController@loanSchedulePrint');
Route::get('/loan/schedule/printpdf/{id}','LoanSubscriptionController@loanSchedulePdf');
});

//Monthly Savings Routes
Route::middleware(['auth'])->group(function () {
Route::get('/saving-deductions','MonthlySavingController@index');
Route::get('/savings/export','MonthlySavingController@export')->name('saving.export');
Route::get('/usersaving/export','MonthlySavingController@export_view')->name('usersaving.export');
Route::get('/saving/create','MonthlySavingController@savingUpload')->name('usersaving.create');
Route::post('/saving/upload','MonthlySavingController@savingImport')->name('savings.upload');
Route::get('/ippis/savings','MonthlySavingController@ippisSavings');
Route::get('/ippis/savings/export','MonthlySavingController@ippisSavingExport')->name('ippisExport');
});

//Contributors
Route::middleware(['auth'])->group(function () {
Route::get('/contributors-list','ContributorsController@index');
Route::get('/inactive-contributors','ContributorsController@inactiveUsers');
Route::get('/recent/savings','ContributorsController@recentUploads');
Route::get('/saving/listings/{id}','ContributorsController@userListings');
Route::get('/saving/edit/{id}','ContributorsController@edit');
Route::post('/saving/update/{id}','ContributorsController@update');
Route::get('/saving/remove/{id}','ContributorsController@destroy');
Route::get('/saving/new/{id}','ContributorsController@create'); 
Route::post('/saving/store','ContributorsController@store');
Route::get('/saving/withdraw/{id}','ContributorsController@savingWithdraw');
Route::post('/saving/withdraw/store','ContributorsController@withdrawalStore');
Route::get('/saving/search','ContributorsController@search');
Route::post('/saving/search/process','ContributorsController@searchProcess');
Route::get('/saving/statement','ContributorsController@statement');
Route::post('/saving/statement/process','ContributorsController@statementFind');
Route::get('/statement/printfile/{from}/{to}/{id}','ContributorsController@printFile');
Route::get('/statement/printpdf/{from}/{to}/{id}','ContributorsController@printPdf');
Route::get('/saving/pending','ContributorsController@pending');
Route::get('/approve/saving/{id}','ContributorsController@approveSaving');
Route::get('/savings/liability','ContributorsController@savingsMaster');
Route::post('/savingliability/find','ContributorsController@savingsMasterFind');
Route::get('/savings/liability','ContributorsController@savingsMaster');
Route::get('/savingliability/excel/{to}','ContributorsController@masterSavingExport');
Route::get('/savingliability/pdf/{to}','ContributorsController@masterSavingPdf');
});

//Monthly Target Savings Routes
Route::middleware(['auth'])->group(function () {
Route::get('/targetsaving-deductions','TargetSavingController@index');
Route::get('/targetsaving/export','TargetSavingController@export')->name('ts.export');
Route::get('/targetsaving/create','TargetSavingController@tsUpload')->name('ts.create');//upload bulk
Route::post('/targetsaving/import','TargetSavingController@tsImport')->name('ts.import');
Route::get('/recent/targetsavings','TargetSavingController@recentTargetSavings');
Route::get('/targetsaving/edit/{id}','TargetSavingController@edit');
Route::post('/ts-saving/update/{id}','TargetSavingController@update');
Route::get('/targetsaving/remove/{id}','TargetSavingController@destroy');
Route::get('/targetsaving/new/{id}','TargetSavingController@create');
Route::post('/targetsaving/store','TargetSavingController@store');
Route::get('/tsSub/detail/{id}','TargetSavingController@tsListings'); 
Route::get('/new/ts/{id}','TargetSavingController@regTs');
Route::post('/new/ts/store','TargetSavingController@regTsStore');
Route::get('/ts/withdrawal/{id}','TargetSavingController@tsWithdraw');
Route::post('/ts/withdrawal/store','TargetSavingController@tsWithdrawalStore');
Route::get('/ts/search','TargetSavingController@tsSearch');
Route::post('/ts/search/process','TargetSavingController@searchProcess');
});


//Loan Deductions
//Unfiltered loan deductions for MIDAS UPLOAD
Route::middleware(['auth'])->group(function () {
Route::get('/loan/deductions','LoanDeductionsController@index');
Route::get('/loanDeductions/export','LoanDeductionsController@export')->name('loans.export');

//Unfiltered loan deductions for IPPIS UPLOAD
Route::get('/ippis/loans','LoanDeductionsController@ippis');
Route::get('/loanDeductions/ippisexport','LoanDeductionsController@defaultIppisExport')->name('default_ippis.export');

//Filtered loan deductions for IPPIS
Route::get('/loan/filter','LoanDeductionsController@filterDeductions');
Route::post('/loan/filterResult','LoanDeductionsController@filterLoanResult');
Route::get('/filterExcel/{start_date}/{end_date}','LoanDeductionsController@excelFilterExport');

//Filtered loan deductions for MIDAS
Route::get('/midasFilterExcel/{start_date}/{end_date}','LoanDeductionsController@midasExcelFilterExport');

//IMPORT LOAN DEDUCTIONS
Route::get('/loan/uploadForm','LoanDeductionsController@importForm');
Route::post('/loan/deductionsImport','LoanDeductionsController@importLoanDeductions')->name('deductions.import');
Route::get('/loanDeduction/listings','LoanDeductionsController@loanDeductions');
Route::get('/loanDeduction/edit/{id}','LoanDeductionsController@edit');
Route::post('/loanDeduction/update/{id}','LoanDeductionsController@update');
Route::get('/loanDeduction/remove/{id}','LoanDeductionsController@destroy');
Route::get('/loanDeduction/history/{id}','LoanDeductionsController@loanDeductionHistory');
Route::get('/loan/payment/{id}','LoanDeductionsController@loanPaymentHome');
Route::get('/bank/repay/{id}','LoanDeductionsController@repay');
Route::post('/loanRepay/store','LoanDeductionsController@repayStore');
Route::get('/saving/repay/{id}','LoanDeductionsController@savingRepay');
Route::post('/saving/repay','LoanDeductionsController@savingRepayStore');
Route::get('/ts/repay/{id}','LoanDeductionsController@tsRepay');
Route::post('/ts/repay','LoanDeductionsController@tsRepayStore');
});

//Monthly Target Savings Routes
Route::middleware(['auth'])->group(function () {
  Route::get('/ippis-analysis','IppisAnalysisController@ippisAnalysisForm');
  Route::post('/ippis-analysis-upload','IppisAnalysisController@importIppisAnalysis')->name('ippisanalysis.import');
  //Route::get('/ippis-analysis/distribute','IppisAnalysisController@distributeAnalysis');
  });


