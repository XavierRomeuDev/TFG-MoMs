<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Translations;

class NewController extends Controller
{
    /**
     * Display a listing of the partners.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $news = News::all();

        return view('dashboard.news.news-list', ['news' => $news]);
    }

    public function news()
    {
        $news = News::all();
        $newsletters = Newsletter::all();
        return view('news', compact('news', 'newsletters'));
    }

    public function showNew($lang, News $new)
    {

        return view('show-new', compact('new'));
    }

    public function create()
    {
        return view('dashboard.news.news-create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description_en' => 'required',
        ]);

        $description_en = $request->input('description_en'); // Get the input without stripping tags

        $images = [];
        if ($request->has('image')) {
            foreach ($request->file('image') as $file) {
                $filename = $file->getClientOriginalName();
                $file->move(public_path('images/news'), $filename);
                $images[] = 'images/news/' . $filename;
            }
        }

        $validatedData['image'] = implode(',', $images);

        if ($request->has('date')){
            $validatedData['date'] = $request->input('date');
        }

        $new = new News;
        $new->title = $request->title;
        $new->image = $validatedData['image'];
        $new->description_en = $description_en;
        $new->date = $validatedData['date'];
        $new->created_at = now();
        $new->updated_at = now();

        $new->save();

        $translation = new Translations();
        $translation->key = 'new_title'.$new->id;
        $translation->value = $new->title;
        $translation->locale = 'en';
        $translation->section = 'news';
        $translation->section_id = $new->id;

        $translation->save();

        $translation = new Translations();
        $translation->key = 'new_description'.$new->id;
        $translation->value = $new->description_en;
        $translation->locale = 'en';
        $translation->section = 'news';
        $translation->section_id = $new->id;

        $translation->save();

        return redirect()->route('dashboard.news.index', ['lang' => app()->getLocale()])
            ->with('status', 'new created successfully.');
    }

    public function edit($lang, News $new)
    {
        return view('dashboard.news.news-edit', compact('new'));
    }

    public function update(Request $request, $lang, News $new)
    {
        $updateSuccessful = false;
        $request->validate([
            'title' => 'required',
            'description_en' => 'required',
        ]);

        $new->title = $request->input('title');

        $existingImages = explode(',', $new->image);
        if ($request->has('image')) {
            $existingImages = [];
            foreach ($request->file('image') as $file) {
                $filename = $file->getClientOriginalName();
                $file->move(public_path('images/news'), $filename);
                $existingImages[] = 'images/news/' . $filename;
            }
        }

        if ($request->has('date')){
            $new->date = $request->input('date');
        }

        $translationTitleExists = Translations::where('section_id', $new->id)->where('locale', 'en')->where('section', 'news')->where('key', 'new_title' . $new->id)->exists();
        $translationDescriptionExists = Translations::where('section_id', $new->id)->where('locale', 'en')->where('section', 'news')->where('key', 'new_description' . $new->id)->exists();

        if (!$translationTitleExists) {
            $translationTitle = new Translations();
            $translationTitle->key = 'new_title' . $new->id;
            $translationTitle->value = $request->title;
            $translationTitle->locale = 'en';
            $translationTitle->section = 'news';
            $translationTitle->section_id = $new->id;
            $translationTitle->save();

        } else {
            $translationTitle = Translations::where('section_id', $new->id)->where('locale', 'en')->where('section', 'news')->where('key', 'new_title' . $new->id)->first();
            $translationTitle->value = $request->title;
            $translationTitle->update();

        }

        if (!$translationDescriptionExists) {
            $translationContent = new Translations();
            $translationContent->key = 'new_description' . $new->id;
            $translationContent->value = $request->description_en;
            $translationContent->locale = 'en';
            $translationContent->section = 'news';
            $translationContent->section_id = $new->id;
            $translationContent->save();
        }
        else{
            $translationContent = Translations::where('section_id', $new->id)->where('locale', 'en')->where('section', 'news')->where('key', 'new_description' . $new->id)->first();
            $translationContent->value = $request->description_en;
            $translationContent->update();
        }

        $new->description_en = $request->description_en;

        $updateSuccessful = $new->save();

        if ($updateSuccessful) {
            // Flash a success message to the session
            session()->flash('message', 'Article updated successfully!');
            session()->flash('alert-class', 'alert-success-custom');
        } else {
            // Flash a failure message to the session
            session()->flash('message', 'Failed to update article.');
            session()->flash('alert-class', 'alert-danger-custom');
        }
        return redirect()->route('dashboard.news.index', ['lang' => app()->getLocale()]);
    }

    public function destroy(News $new)
    {
        $new->delete();

        return redirect()->route('dashboard.news.index', ['lang' => app()->getLocale()])
            ->with('status', 'News deleted successfully.');
    }

}
