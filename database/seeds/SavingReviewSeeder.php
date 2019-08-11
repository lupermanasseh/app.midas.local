<?php

use Illuminate\Database\Seeder;

class SavingReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $savingreview = factory(App\Savingreview::class,10)->create([
            'user_id' =>$this->getRandomUserId(),
            'created_by' =>$this->getRandomUserId(),
        ]);
    }
    private function getRandomUserId(){
        $user = \App\User::inRandomOrder()->first();
        return $user->id;
    }
}
