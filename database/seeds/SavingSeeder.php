<?php

use Illuminate\Database\Seeder;

class SavingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $saving = factory(App\Saving::class,1297)->create([
            'user_id' =>$this->getRandomUserId(),
            'created_by' =>$this->getRandomUserId(),
        ]);
    }

    private function getRandomUserId(){
        $user = \App\User::inRandomOrder()->first();
        return $user->id;
    }
}
