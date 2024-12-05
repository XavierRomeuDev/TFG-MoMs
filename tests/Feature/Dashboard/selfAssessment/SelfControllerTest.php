<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\SelfAssessment;
use App\Models\SelfQuestions;
use Tests\TestCase;

class SelfControllerTest extends TestCase
{

    public function test_index_displays_self_assessments()
    {
        $user = User::factory()->create();
        $selfAssessment = SelfAssessment::factory()->create();

        $response = $this->actingAs($user)->get(route('dashboard.self.index', ['lang' => app()->getLocale()]));

        $response->assertStatus(200)
                 ->assertViewHas('selfs')
                 ->assertSee($selfAssessment->title_en);
    }

    public function test_create_displays_create_self_assessment_form()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('dashboard.self.create', ['lang' => app()->getLocale()]));

        $response->assertStatus(200)
                 ->assertViewIs('dashboard.self.self-create');
    }

    public function test_store_creates_new_self_assessment()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('dashboard.self.store', ['lang' => app()->getLocale()]), [
            'title_en' => 'New Self Assessment',
        ]);

        $response->assertRedirect(route('dashboard.self.index', ['lang' => app()->getLocale()]))
                 ->assertSessionHas('status', 'self created successfully.');
        $this->assertDatabaseHas('self', [
            'title_en' => 'New Self Assessment',
        ]);
    }

    public function test_edit_displays_edit_self_assessment_form()
    {
        $user = User::factory()->create();
        $selfAssessment = SelfAssessment::factory()->create();

        $response = $this->actingAs($user)->get(route('dashboard.self.edit', ['lang' => app()->getLocale(), 'self' => $selfAssessment->id]));

        $response->assertStatus(200)
                 ->assertViewHas('self')
                 ->assertSee($selfAssessment->title_en);
    }

}
