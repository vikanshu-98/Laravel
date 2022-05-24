<?php

namespace Database\Seeders;

use App\Models\customer as ModelsCustomer;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class customer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
        for($i=1;$i<=100;$i++){
            $faker = Faker::create();
            $ob1= new ModelsCustomer();
            $ob1->name =$faker->name();
            $ob1->email = $faker->email();
            $ob1->password=$faker->password();
            $ob1->gender  = "Male";
            $ob1->save();
        }
 

    }
}
