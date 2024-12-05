<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class LoginPageTest extends TestCase
{

    public function test_login_form_submits_with_valid_data()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password123'),
        ]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/en/home');
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_form_fails_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    
    public function test_login_form_validation()
    {
        $response = $this->post(route('login'), [
            'email' => 'invalid-email@email.com',
            'password' => 'Password1.',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
    }
}
