<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class NewsControllerTest extends TestCase
{
    public function test_index_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $response = $this->get(route('dashboard.news.index', ['lang' => app()->getLocale()]));

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.news.news-list');
    }

    public function test_create_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $response = $this->get(route('dashboard.news.create', ['lang' => app()->getLocale()]));

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.news.news-create');
    }

}
