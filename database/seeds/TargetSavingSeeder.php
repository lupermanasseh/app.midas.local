<?php

use Illuminate\Database\Seeder;

class TargetSavingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $saving = factory(App\Targetsaving::class,1000)->create([
            'user_id' =>$this->getRandomUserId(),
            'created_by' =>$this->getRandomUserId(),
        ]);
    }
    private function getRandomUserId(){
        $user = \App\User::inRandomOrder()->first();
        return $user->id;
    }
}
