<?php

use Illuminate\Database\Seeder;

class LoanSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //
        $loanSubcription = factory(App\Lsubscription::class,30)->create([
            'user_id' =>$this->getRandomUserId(),
            'loan_id' =>$this->getRandomLoanId(),
            'created_by' =>$this->getRandomUserId(),
        ]);
    }

     //Get random user id
     private function getRandomUserId(){
        $user = \App\User::inRandomOrder()->first();
        return $user->id;
    }
    
    //Get random loan product id
    private function getRandomLoanId(){
        $loan = \App\Loan::inRandomOrder()->first();
        return $loan->id;
    }
}
