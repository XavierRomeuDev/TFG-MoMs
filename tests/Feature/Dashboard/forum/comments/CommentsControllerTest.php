<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentsControllerTest extends TestCase
{

    public function test_comment_can_be_stored(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('comments.store', $post->id), [
            'content' => 'This is a comment.',
        ]);

        $response->assertRedirect(route('forum.showApproved', ['lang' => app()->getLocale()]));
        $this->assertDatabaseHas('post_comments', [
            'post_id' => $post->id,
            'user_id' => $user->id,
            'content' => 'This is a comment.',
        ]);
    }

    public function test_store_comment_requires_content(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('comments.store', $post->id), [
            'content' => '',
        ]);

        $response->assertSessionHasErrors(['content']);
        $this->assertDatabaseMissing('post_comments', [
            'post_id' => $post->id,
            'user_id' => $user->id,
        ]);
    }
}
