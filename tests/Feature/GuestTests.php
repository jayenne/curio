<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuestTests extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginPageFound()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
}
