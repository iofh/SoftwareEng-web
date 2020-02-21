<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use GamesTableSeeder;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->seed();
        $this->seed(GamesTableSeeder::class);
        $response = $this->get('/games');

        $response->assertSeeText('Minecraffft');
    }
}
