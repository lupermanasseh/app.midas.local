<?php

use Illuminate\Database\Seeder;

class ProductSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $productSubcription = factory(App\Psubscription::class,20)->create([
            'user_id' =>$this->getRandomUserId(),
            'Product_id' =>$this->getRandomProductId(),
            'staff_id' =>$this->getRandomUserId(),
        ]);
    }
    //Get random user id
    private function getRandomUserId(){
        $user = \App\User::inRandomOrder()->first();
        return $user->id;
    }
    //Get random product id
    private function getRandomProductId(){
        $product = \App\Product::inRandomOrder()->first();
        return $product->id;
    }
}
