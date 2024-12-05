<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Comment;
use Tests\TestCase;

class ForumControllerTest extends TestCase
{
  
    public function test_create_displays_post_creation_form()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('forum.create', ['lang' => app()->getLocale()]));

        $response->assertStatus(200)
                ->assertViewHas('availableTags');
    }


    public function test_store_creates_new_post()
    {
        $user = User::factory()->create();

        // Generate a unique tag name for the test
        $tagName = 'Unique Tag ' . uniqid();
        $tag = Tag::factory()->create(['name' => $tagName]);

        $this->actingAs($user);

        $response = $this->post(route('forum.store', ['lang' => app()->getLocale()]), [
            'title' => 'New Post',
            'description' => 'This is a new post description.',
            'tags' => [$tag->id], // Ensure to use tag ID here
        ]);

        $response->assertRedirect(route('dashboard.forum.index', ['lang' => app()->getLocale()]));
        $this->assertDatabaseHas('posts', [
            'title' => 'New Post',
            'description' => 'This is a new post description.',
            'user_id' => $user->id,
        ]);
    }

    public function test_reviewPost_displays_post_review_page()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->actingAs($user)->get(route('dashboard.forum.review', ['lang' => app()->getLocale(), 'post' => $post->id]));

        $response->assertStatus(200)
                 ->assertViewHas('post');
    }

    public function test_approveOrDeny_approves_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();
    
        $this->actingAs($user);
    
        // Change from post to patch
        $response = $this->patch(route('dashboard.forum.approveOrDeny', [
            'lang' => app()->getLocale(),
            'post' => $post->id,
        ]), [
            'action' => 'approve',
        ]);
    
        $response->assertRedirect(route('dashboard.forum.index', ['lang' => app()->getLocale()]))
                 ->assertSessionHas('status', 'Post updated successfully');
    
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'approved' => 2,
        ]);
    }    

    public function test_edit_displays_edit_post_form()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $response = $this->actingAs($user)->get(route('forum.edit', ['lang' => app()->getLocale(), 'post' => $post->id]));

        $response->assertStatus(200)
                 ->assertViewHas('post')
                 ->assertViewHas('availableTags');
    }

    public function test_delete_removes_post_and_comments()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $comment = Comment::factory()->create(['post_id' => $post->id]);

        $this->actingAs($user);

        $response = $this->delete(route('forum.delete', ['lang' => app()->getLocale(), 'post' => $post->id]));

        $response->assertRedirect(route('dashboard.forum.index', ['lang' => app()->getLocale()]))
                ->assertSessionHas('status', 'Post deleted successfully');
        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
        ]);
        $this->assertDatabaseMissing('post_comments', [
            'id' => $comment->id,
        ]);
    }

}
