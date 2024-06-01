<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    public function test_is_a_user_can_be_created(): void
    {
        // Create a request
        $request = $this->post('/admin/user/create',[
            'name' => 'user test',
            'email' => 'user.test@mail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'user',
        ]);
        
        // Check if the resonse status is correct
        $request->assertStatus(201);

        // Check if the created is added on database
        $this->assertDatabaseHas('users', [
            'email' => 'user.test@mail.com',
        ]);
    }


}
