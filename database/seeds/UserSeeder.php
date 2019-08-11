<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\User::class,1300)->create()->each(function ($user){
            //seed each user relationship with one NOK
            $nok = factory(App\Nok::class)->make();
            $user->nok()->save($nok);

            //seed each user relationship with one Bank
            $bank = factory(App\Bank::class)->make();
            $user->bank()->save($bank);

            //seed each user relationship with 12 savings 
            $saving = factory(App\Saving::class,12)->make();
            $user->usersavings()->saveMany($saving);

            //seed each user relationship with 2 savings review 
            $savingreview = factory(App\Savingreview::class,2)->make();
            $user->savingreviews()->saveMany($savingreview);

            //seed each user relationship with 4 product subscriptions
            $psub = factory(App\Psubscription::class,4)->make();
            $user->psubscriptions()->saveMany($psub);

            //seed each user relationship with 2 loan subscriptions
            $loansub = factory(App\Lsubscription::class,2)->make();
            $user->loansubscriptions()->saveMany($loansub);

             //seed each user relationship with 12 Target saving
             $targetsaving = factory(App\Targetsaving::class,12)->make();
             $user->targetsavings()->saveMany($targetsaving);

             //seed each user relationship with 2 target saving reviews
             $targetsr = factory(App\Targetsr::class,2)->make();
             $user->tsreviews()->saveMany($targetsr);

        });
    }
}
