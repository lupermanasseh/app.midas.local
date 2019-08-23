<?php
namespace App;
use App\Saving;
use App\Savingreview;
use App\Psubscription;
use App\Lsubscription;
use App\Charts\membershipSpread;
use Carbon\Carbon;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 
        'payment_number', 
        'password',
        'email',
        'membership_type',
        'created_at',
        'updated_at',
        'staff_no',
        'title',
        'first_name',
        'last_name',
        'other_name',
        'sex',
        'dept',
        'email',
        'phone',
        'marital_status',
        'home_add',
        'dob',
        'employ_type',
        'job_cadre',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['created_at', 'updated_at','dob'];


    //accessor methods
    public function getPhotoAttribute($photo){
        return asset($photo);
    }
    //Define relationship with roles
    public function roles(){
        return $this->belongsToMany(Role::class,'role_users');
    }

    //define relationship with next of kin
    public function nok(){
        return $this->hasOne(Nok::class);
    }

    //define relationship with user bank details
    public function bank(){
        return $this->hasOne(Bank::class);
    }

    //Define relationship with product subscription
    //done; A user has many product subscriptions
    public function psubscriptions(){
        return $this->hasMany(Psubscription::class);
    }
    //User relationship with loan subscriptions
    //User has many subscriptions 
     public function loansubscriptions(){
        return $this->hasMany(Lsubscription::class);
    }

    //Relationship with Target Savings Review
    public function tsreviews(){
        return $this->hasMany(Targetsr::class);
    } 

    //Relationship with Target Saving
    public function targetsavings(){
        return $this->hasMany(Targetsaving::class);
    }

    //Relationship with Saving
    public function usersavings(){
        return $this->hasMany(Saving::class);
    }

    //Relationship with saving reviews
    public function savingreviews(){
        return $this->hasMany(Savingreview::class);
    }

     //Relationship with loan deductions
     public function loandeductions(){
        return $this->hasMany(Ldeduction::class);
    }

    //Relationship with Product deductions
     public function productdeductions(){
        return $this->hasMany(Productdeduction::class);
    }

    //Total sum deductible for product subscription
    // public function productSubscriptionTotal($id)
    // {
       
    //     return Psubscription::where('user_id', '=', $id)
    //     ->where(function ($query) {
    //         $query->where('status', '=', 'Active');
    //     })->with(['user'=> function ($q){
    //         $q->where('status','Active');
    //     }])
    //     ->sum('monthly_repayment');
    // }


     //Total sum deductible for loan subscription
     public function loanSubscriptionTotal($id)
     {
         return Lsubscription::where('user_id', '=', $id)
         ->where(function ($query) {
             $query->where('loan_status', '=', 'Active');
         })
         ->sum('monthly_deduction');
     }

        //Total sum approved loan amount

        public function totalApprovedAmount($id)
        {
            return Lsubscription::where('user_id', '=', $id)
            ->where(function ($query) {
                $query->where('loan_status', '=', 'Active');
            })
            ->sum('amount_approved');
        }

    
        //All loan balances
        public function allLoanBalances($id)
        {
            $sumBal=0;
            $lsub = new Lsubscription;
            $all_loans = Lsubscription::where('user_id', '=', $id)
            ->where(function ($query) {
                $query->where('loan_status', '=', 'Active');
            })->get();
        
            foreach($all_loans as $item){
                //$totalBal=0;
                $approved_amt = $item->amount_approved;
                $deductions = $lsub->totalLoanDeductions($item->id);
                $bal = $approved_amt-$deductions;
                $sumBal = $sumBal+$bal;
            }
            return $sumBal;
        }


    public  function totalSavings($id)
    {
        //
        return Saving::where('user_id',$id)->sum('amount_saved');
    }

    public  function monthlySaving($id)
    {
      
        $userSavingRev = Savingreview::where('user_id', '=', $id)
                                    ->where('status','Active')
                                    ->first();
            
        return $userSavingRev->current_amount;
    }

    //Is Active User
    public function isActive($id){
        $active =$this::where('user_id', '=', $id)
        ->where(function ($query) {
            $query->where('status', '=', 'Active');
        })->get();
    }

    //Number of active Loans
    public  function activeLoans($id)
    {
        //Number of active loans
        $activeLoans = Lsubscription::where('user_id', '=', $id)
        ->where(function ($query) {
            $query->where('loan_status', '=', 'Active');
        })->get();
        return $activeLoans->count();
    }

    //Number of Pending Loans
    public  function pendingLoans($id)
    {
        //Number of pending loans
        $pendingLoans = Lsubscription::where('user_id', '=', $id)
        ->where(function ($query) {
            $query->where('loan_status', '=', 'Pending');
        })->get();
        return $pendingLoans->count();
    }

  

    //Number of active product subscriptions
    // public  function activeProductSub($id)
    // {
    //     //Number of active product subsriptions
    //     $activeProdSub = Psubscription::where('user_id', '=', $id)
    //     ->where(function ($query) {
    //         $query->where('status', '=', 'Active');
    //     })->get();
    //     return $activeProdSub->count();
    // }

    public function requiredPercent($amt){
        return 0.3 * $amt;
    }

    public function availablePercent($id){
        return 0.3 * $this->totalSavings($id);
    }

   //Get user ID  BY IPPIS NUMBER
   /**
    * @param int $ippis
    */
   public static function userID($ippis){
        $user = static::where('payment_number', '=', $ippis)
                        ->where('status', '=', 'Active')
                        ->first();
            return $user->id;
   }

   //GET USER OBJECT BY ID
   public function userInstance($id){
       $user= $this::find($id);
       return $user;
   }

   //Product guarantor count
   public function guarantorCount($id){
        return Psubscription::where('guarantor_id', '=', $id)->count();
   }

   //Loan guarantor count
   public function loanGuarantorCount($id){
    return Lsubscription::where('guarantor_id', '=', $id)
                        ->orWhere('guarantor_id2',$id)
                        ->count();
}

   
        //Search User
public function searchUser($param){
            $result = User::where('id',$param)
                            ->get();
                            return $result;
        }

//use this search functionality for general search
        //Search User
// public function searchUser($param){
//             $result = User::where('first_name','like','%'.$param.'%')
//                             ->orWhere('id',$param)
//                             ->get();
//                             return $result;
//         }

//filter members
public static function filterMembers($status,$end_date,$cadre){

    $startDate = new Carbon('2016-02-01');
    if($status=='All' &&  $cadre=='All'){
        return User::where('created_at','>=',$startDate)
                    ->where('created_at','<=',$end_date)
                    ->orderBy('status','asc')
                    ->paginate(100); 
    }else{
    return User::where('created_at','>=',$startDate)
                    ->where('created_at','<=',$end_date)
                    ->where('job_cadre','like','%'.$cadre.'%')
                    ->where('status',$status)
                    ->orderBy('first_name','asc')
                    ->paginate(100);
    }
}

public static function membershipByGender(){
            // $data = User::groupBy('sex')
            // ->get()
            // ->map(function ($item) {
            //     // Return the number of persons with that age
            //     return count($item);
            // });

        $female = User::where('sex', 'Female')->count();
        $male = User::where('sex', 'Male')->count();
        
        $chart = new membershipSpread;
        $chart->labels(['Male','Female']);
        $chart->dataset('Membership Spread By Gender', 'pie', [$male,$female]);
        return $chart;
}
    // public static function totalSavings($id)
    // {
    //     return static::selectRaw('users.name, count(*) submitted_games')
    //         ->join('games', 'games.user_id', '=', 'users.id')
    //         ->groupBy('users.name')
    //         ->orderBy('submitted_games', 'DESC')
    //         ->get();
    // }


    //has access method used in authserviceprovider
    public function hasAccess(array $permissions)
    {
        foreach($this->roles as $roles){
            if($role->hasAccess($permissions)){
                return true;
            }
        }
        return false;
    }

    public function inRole($name){
        return $this->roles()->where('name',$name)
        ->count()==1;
    }

    public function checkRole(){
        return $this->roles()->pluck('name')->count()>=1;
    }
}
