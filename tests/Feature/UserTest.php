<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    public function test_is_a_user_can_be_created(): void
    {
        // For see exceptions
        // $this->withoutExceptionHandling();
        // Create an admin user
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);
        // Create a request
        $this
            ->actingAs($admin)
            ->post(route('admin.user.store'), [
                'name' => 'user test',
                'email' => 'user.test@mail.com',
                'password' => 'Passw0rd!',
                'password_confirmation' => 'Passw0rd!',
                'role' => 'user',
            ])
            ->assertRedirect('admin');

        // Check if the created is added on database
        $this->assertDatabaseHas('users', [
            'email' => 'user.test@mail.com',
        ]);
    }

    public function test_is_a_user_can_be_updated(): void
    {
        // $this->withoutExceptionHandling();

        // Create an admin user
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        // Create a user
        $user = User::factory()->create([
            'name' => 'Jean Dutest',
            'email' => 'dutest.jean@mail.com',
        ]);

        // Check if user is created
        $this->assertDatabaseHas('users', [
            'name' => 'Jean Dutest',
            'email' => 'dutest.jean@mail.com',
        ]);

        // Update the user name and email with a PATCH request
        $this
            ->actingAs($admin)
            ->patch(route('admin.user.update', ['user' => $user]), [
                'name' => 'Jean Delessai',
                'email' => 'delessai.jean@mail.fr',
                'role' => 'user',
            ])
            ->assertRedirect('admin');

        // Assert old user values is missing
        $this->assertDatabaseMissing('users', [
            'name' => 'Jean Dutest',
            'email' => 'dutest.jean@mail.com',
        ]);

        // Assert new values is here
        $this->assertDatabaseHas('users', [
            'name' => 'Jean Delessai',
            'email' => 'delessai.jean@mail.fr',
        ]);
    }

    public function test_is_a_user_can_be_deleted(): void
    {
        // Create an Admin user
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);
        // Create a user
        $user = User::factory()->create([
            'name' => 'jean Dutest',
        ]);
        // Assert user is created
        $this->assertDatabaseHas('users', [
            'name' => 'jean Dutest',
        ]);
        // Send a DELETE request
        $this
        ->actingAs($admin)
        ->delete(route('admin.user.destroy', ['user' => $user]))
        ->assertRedirect('admin');
        // Assert user is missing
        $this->assertDatabaseMissing('users', [
            'name' => 'jean Dutest',
        ]);
    }
}
