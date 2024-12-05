<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;


class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();

        return view('dashboard.tags.tags-list', ['tags' => $tags]);
    }


    public function createTag()
    {
        return view('dashboard.tags.create-tag');
    }

    public function storeTag(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $tag = Tag::firstOrCreate(['name' => $request->name]);

        return redirect()->route('dashboard.tags.index', ['lang' => app()->getLocale()])
                         ->with('status', 'Tag created successfully.');
    }

    public function edit($lang, Tag $tag)
    {
        return view('dashboard.tags.tags-edit', compact('tag'));
    }

    public function update(Request $request, $lang, Tag $tag)
    {
        $request->validate([
            'name' => 'nullable',
        ]);

        $tag->name = $request->input('name');

        $tag->save();

        return redirect()->route('dashboard.tags.index', ['lang' => app()->getLocale()])
                         ->with('status', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('dashboard.tags.index', ['lang' => app()->getLocale()])
                         ->with('status', 'Tag created successfully.');
    }
}
