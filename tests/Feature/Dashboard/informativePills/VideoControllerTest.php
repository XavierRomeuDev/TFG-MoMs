<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Video;
use Tests\TestCase;

class VideoControllerTest extends TestCase
{
    public function test_index_displays_videos()
    {
        $user = User::factory()->create();
        $video = Video::factory()->create();

        $response = $this->actingAs($user)->get(route('dashboard.pills.index', ['lang' => app()->getLocale()]));

        $response->assertStatus(200)
                 ->assertViewHas('pills')
                 ->assertSee($video->title);
    }

    public function test_create_displays_create_video_form()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('dashboard.pills.create', ['lang' => app()->getLocale()]));

        $response->assertStatus(200)
                 ->assertViewIs('dashboard.informative-pills.create-pill');
    }

    public function test_store_creates_new_video()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('pills.store', ['lang' => app()->getLocale()]), [
            'title' => 'New Video',
            'description' => 'This is a new video.',
            'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ]);

        $response->assertRedirect(route('dashboard.pills.index', ['lang' => app()->getLocale()]))
                 ->assertSessionHas('status', 'Pill created successfully.');
        $this->assertDatabaseHas('videos', [
            'title' => 'New Video',
            'url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
        ]);
    }

    public function test_edit_displays_edit_video_form()
    {
        $user = User::factory()->create();
        $video = Video::factory()->create();

        $response = $this->actingAs($user)->get(route('dashboard.pills.edit', ['lang' => app()->getLocale(), 'pill' => $video->id]));

        $response->assertStatus(200)
                 ->assertViewHas('pill')
                 ->assertSee($video->title);
    }

    public function test_update_edits_video()
    {
        $user = User::factory()->create();
        $video = Video::factory()->create();

        $this->actingAs($user);

        $response = $this->patch(route('dashboard.pills.update', ['lang' => app()->getLocale(), 'pill' => $video->id]), [
            'title' => 'Updated Video Title',
            'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ]);

        $response->assertRedirect(route('dashboard.pills.index', ['lang' => app()->getLocale()]))
                 ->assertSessionHas('status', 'Tag created successfully.');
        $this->assertDatabaseHas('videos', [
            'id' => $video->id,
            'title' => 'Updated Video Title',
            'url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
        ]);
    }

    public function test_destroy_deletes_video()
    {
        $user = User::factory()->create();
        $video = Video::factory()->create();

        $this->actingAs($user);

        $response = $this->delete(route('dashboard.pills.destroy', ['lang' => app()->getLocale(), 'pill' => $video->id]));

        $response->assertRedirect(route('dashboard.pills.index', ['lang' => app()->getLocale()]))
                ->assertSessionHas('status', 'Tag created successfully.');
        $this->assertDatabaseMissing('videos', [
            'id' => $video->id,
        ]);
    }

}
