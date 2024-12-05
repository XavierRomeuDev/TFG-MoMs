<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;


class ForumController extends Controller
{
    public function index(Request $request)
    {
        $tagFilter = $request->input('tag');

        if ($tagFilter) {
            $posts = Post::whereHas('tags', function ($query) use ($tagFilter) {
                $query->where('id', $tagFilter);
            })->get();
        }
        else {
            $posts = Post::all();
        }

        $availableTags = Tag::all();

        return view('dashboard.forum.posts-list', [
            'posts' => $posts,
            'availableTags' => $availableTags,
            'selectedTag' => $tagFilter
        ]);
    }

    public function showApproved(Request $request)
     {
         $query = Post::where('approved', 2)->with('comments.user')->orderByDesc('id');

         if ($request->has('tag')) {
             $tagId = $request->tag;
             $query->whereHas('tags', function ($query) use ($tagId) {
                 $query->where('id', $tagId);
             });
         }

         $posts = $query->get();
         $availableTags = Tag::all();

         return view('forum', [
             'posts' => $posts,
             'availableTags' => $availableTags,
             'selectedTag' => $request->tag ?? null,
         ]);
     }


    public function create()
    {
        $availableTags = Tag::all();
        return view('dashboard.forum.post-create', compact('availableTags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required|array'
        ]);

        $post = Post::create([
                    'user_id' => auth()->id(),
                    'title' => $request->title,
                    'description' => strip_tags($request->description),
                    'approved' => false,
                ]);

        $tags = [];
        foreach ($request->tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tags[] = $tag->id;
        }

        $post->tags()->sync($tags);

        return redirect()->route('dashboard.forum.index', ['lang' => app()->getLocale()])->with('status', 'Post created successfully. Waiting for approval');
    }

    public function reviewPost($lang, Post $post){
        return view('dashboard.forum.post-review', compact('post'));
    }

   public function approveOrDeny(Request $request, $lang, Post $post)
    {
        $request->validate([
            'action' => 'required|in:approve,deny',
        ]);

        $updateData = [];

        if ($request->action === 'approve') {
            $updateData['approved'] = 2;
        } elseif ($request->action === 'deny') {
            redirect()->route('dashboard.forum.index', ['lang' => $lang])
                        ->with('status', 'Post denied');
        }

        if (!empty($updateData)) {
            DB::table('posts')
                    ->where('id', $post->id)
                    ->update($updateData);
        }

        return redirect()->route('dashboard.forum.index', ['lang' => $lang])
                        ->with('status', 'Post updated successfully');
    }

    public function edit($lang, Post $post)
    {
        $availableTags = Tag::all();
        return view('dashboard.forum.post-edit', compact('post', 'availableTags'));
    }

    public function update (Request $request, $lang, Post $post){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required|array'
        ]);

        $post->update([
            'title' => $request->title,
            'description' => strip_tags($request->description),
        ]);

        $tags = [];
        foreach ($request->tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tags[] = $tag->id;
        }

        $post->tags()->sync($tags);

        return redirect()->route('dashboard.forum.index', ['lang' => app()->getLocale()])->with('status', 'Post updated successfully');
    }

    public function delete($lang, Post $post, Comment $comments){
        $comments->where('post_id', $post->id)->delete();
        $post->delete();
        return redirect()->route('dashboard.forum.index', ['lang' => app()->getLocale()])->with('status', 'Post deleted successfully');
    }
}
