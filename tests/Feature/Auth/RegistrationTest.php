<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class RegistrationTest extends TestCase
{

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test2@example.com',
            'password' => 'Password1.',
            'password_confirmation' => 'Password1.',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/en/verify-email');
    }
}
