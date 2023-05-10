<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class FirstCustomTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_first_custom()
    {
        $response = $this->get('/fileUpload');
         pp(User::inRandomOrder());
        $response->assertStatus(200);
    }
}
