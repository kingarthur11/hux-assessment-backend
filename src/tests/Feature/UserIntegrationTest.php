<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserIntegrationTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function testIntegrationCreateUser()
    // {
    //     $userData = [
    //         'email' => $this->faker->unique()->safeEmail,
    //         'firstName' => $this->faker->firstName,
    //         'lastName' => $this->faker->lastName,
    //     ];
    //     $response = $this->post('/api/create-user', $userData);
    //     $this->assertDatabaseHas('users', $userData);
    //     $response->assertStatus(201);
    // }

}
