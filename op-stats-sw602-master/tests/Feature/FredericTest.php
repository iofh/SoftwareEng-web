<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FredericTest extends TestCase
{
    public function testExample()
    {
        $response = $this->get('/')
        ->click('About')
        ->seePageIs('/about');
    }
    public function testNonExistingPage()
    {
        $response=$this->get('/nonExistPage');
        $response->assertStatus(404);
    }
    public function testAuthViewCreateScorePage()
    {
        $response = $this->get('/scores/create?1');
        $response->assertRedirect("http://localhost/login");
    }
}
