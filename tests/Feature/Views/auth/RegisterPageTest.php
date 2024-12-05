<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_form_submits_with_valid_data()
    {
        $response = $this->post(route('register'), [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(RouteServiceProvider::CONFIRM);
        $this->assertDatabaseHas('users', [
            'email' => 'testuser@example.com',
        ]);
    }

    public function test_registration_form_fails_with_duplicate_email()
    {
        // Given: A user already exists
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
        ]);
    
        // When: Trying to register with the same email
        $response = $this->post(route('register'), [
            'name' => 'Another User',
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
    
        // Then: It should fail with a duplicate email error
        $response->assertStatus(302); // Redirect back to form with errors
        $response->assertSessionHasErrors('email');
        $this->assertCount(1, User::where('email', 'testuser@example.com')->get());
    }            
}
