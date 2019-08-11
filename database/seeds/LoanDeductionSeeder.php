<?php

use Illuminate\Database\Seeder;

class LoanDeductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $loanSubcription = factory(App\Ldeduction::class,700)->create([
            'lsubscription_id' =>$this->getRandomLoanSubId(),
            'uploaded_by' =>$this->getRandomUserId(),
        ]);
    }

    //Get random user id
    private function getRandomUserId(){
        $user = \App\User::inRandomOrder()->first();
        return $user->id;
    }

    //Get random loan subcription id
    private function getRandomLoanSubId(){
        $lsub = \App\Lsubscription::inRandomOrder()->first();
        return $lsub->id;
    }
}
