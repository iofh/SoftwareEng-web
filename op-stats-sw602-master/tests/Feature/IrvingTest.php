<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Feature\User;
use UsersTableSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class IrvingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUnautorizedCreateScore()
    {
        $response = $this->get('/scores/create?1');

        $response->assertStatus(302);
    }

    public function testAutorizedViewCreateScorePage()
    {
        $response = $this->get('/scores/create?1');
        $response->assertRedirect("http://localhost/login");
    }

    public function testFindingNonExistingPage()
    {
        $response = $this->get('/nonExistPage');

        $response->assertStatus(404);
    }


    public function testCheckGameIsInside()
    {
        $this->seed(UsersTableSeeder::class);
        $response = $this->get('/showUser');
        $response->assertSeeText("ben");
    }

}
