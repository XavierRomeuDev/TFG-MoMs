<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Tag;
use Tests\TestCase;

class TagControllerTest extends TestCase
{

    public function test_index_displays_tags()
    {
        $user = User::factory()->create();
        $tag = Tag::factory()->create();

        $response = $this->actingAs($user)->get(route('dashboard.tags.index', ['lang' => app()->getLocale()]));

        $response->assertStatus(200)
                 ->assertViewHas('tags')
                 ->assertSee($tag->name);
    }

    public function test_createTag_displays_create_tag_form()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('dashboard.tags.create', ['lang' => app()->getLocale()]));

        $response->assertStatus(200)
                 ->assertViewIs('dashboard.tags.create-tag');
    }

    public function test_storeTag_creates_new_tag()
    {
        $user = User::factory()->create();
    
        $this->actingAs($user);
    
        $response = $this->post(route('tags.storeTag', ['lang' => app()->getLocale()]), [
            'name' => 'New Tag',
        ]);
    
        $response->assertRedirect(route('dashboard.tags.index', ['lang' => app()->getLocale()]))
                 ->assertSessionHas('status', 'Tag created successfully.');
        $this->assertDatabaseHas('tags', [
            'name' => 'New Tag',
        ]);
    }

    public function test_edit_displays_edit_tag_form()
    {
        $user = User::factory()->create();
        $tag = Tag::factory()->create();

        $response = $this->actingAs($user)->get(route('dashboard.tags.edit', ['lang' => app()->getLocale(), 'tag' => $tag->id]));

        $response->assertStatus(200)
                 ->assertViewHas('tag')
                 ->assertSee($tag->name);
    }

}