<?php

use Illuminate\Database\Seeder;

class LoanProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $loanProduct = factory(App\Loan::class,4)->create();
    }
}
