<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class ForgotPasswordPageTest extends TestCase
{

    public function test_password_reset_request_form_submits_with_valid_data()
    {
        $user = User::factory()->create();

        $response = $this->post(route('password.email'), [
            'email' => $user->email,
        ]);

        $response->assertStatus(302); // Assuming a redirect happens on successful submission
        $response->assertSessionHas('status', __('We have emailed your password reset link.')); // Assuming a success message is set in the session
    }

    public function test_password_reset_request_form_validation()
    {
        $response = $this->post(route('password.email'), [
            'email' => 'invalid-email',
        ]);

        $response->assertStatus(302); // Redirect back to form with errors
        $response->assertSessionHasErrors(['email']);
    }
}

