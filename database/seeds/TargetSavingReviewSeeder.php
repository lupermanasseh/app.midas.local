<?php

use Illuminate\Database\Seeder;

class TargetSavingReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $targetsavingreview = factory(App\Targetsr::class,1000)->create([
            'user_id' =>$this->getRandomUserId(),
            'review_by' =>$this->getRandomUserId(),
        ]);
    }
    private function getRandomUserId(){
        $user = \App\User::inRandomOrder()->first();
        return $user->id;
    }
}
