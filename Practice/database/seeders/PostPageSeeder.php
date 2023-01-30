<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class PostPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker = Faker::create(); 
        for($i=1;$i<=10;$i++){ 
            $page =Page::create(['pageName'=>$faker->text(30),'content'=>$faker->text(200)]); 
            $page->comments()->create();
            $post = Post::create(['tittle'=>$faker->text(30)]);
            $post->comments()->create();
        } 
    }
}
