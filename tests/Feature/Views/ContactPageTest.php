<?php

namespace Tests\Feature;

use Tests\TestCase;

class ContactPageTest extends TestCase
{

    public function test_contact_form_validation()
    {
        $response = $this->post('/validate-recaptcha-v3', [
            'name' => '',
            'email' => 'invalid-email',
            'message' => '',
        ]);

        $response->assertStatus(302); 
        $response->assertSessionHasErrors(['name', 'email', 'message']);
    }
}

