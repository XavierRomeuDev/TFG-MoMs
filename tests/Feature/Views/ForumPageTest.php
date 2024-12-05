<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Tag;

class ForumPageTest extends TestCase
{

    public function test_forum_page_shows_available_tags()
    {
        $tags = Tag::factory()->count(3)->create();

        $response = $this->get(route('forum.showApproved', ['lang' => app()->getLocale()]));

        foreach ($tags as $tag) {
            $response->assertSee($tag->name);
        }

        $response->assertSee('All Tags');
    }

    public function test_forum_page_shows_posts()
    {
        $post = Post::factory()->create();

        $response = $this->get(route('forum.showApproved', ['lang' => app()->getLocale()]));

        $response->assertSee($post->title);
        $response->assertSee($post->description);
        $response->assertSee($post->user->name);
    }

    public function test_forum_page_shows_post_comments()
    {
        $post = Post::factory()->has(Comment::factory()->count(2))->create();

        $response = $this->get(route('forum.showApproved', ['lang' => app()->getLocale()]));

        foreach ($post->comments as $comment) {
            $response->assertSee($comment->content);
            $response->assertSee($comment->user->name);
        }
    }

    public function test_authenticated_user_can_submit_comment()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('comments.store', $post), [
            'content' => 'This is a test comment',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('post_comments', [
            'content' => 'This is a test comment',
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);
    }

   
}
