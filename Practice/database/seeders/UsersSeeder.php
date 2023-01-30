<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder; 
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<20;$i++){ 
            $faker           = Faker::create();
            $user            = new User();
            $user->email     = $faker->email();
            $user->name      = $faker->name();
            $user->password  = Hash::make(123456);
            $user->save();
        } 
    }
}
