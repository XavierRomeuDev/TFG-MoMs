<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the partners.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $newsletter = Newsletter::all();

        return view('dashboard.newsletters.newsletter-list', ['newsletter' => $newsletter]);
    }

    public function news()
    {
        $newsletter = Newsletter::all();
        return view('newsletter', compact('newsletter'));
    }

    public function create()
    {
        return view('dashboard.newsletters.newsletter-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('images/newsletter/'. $request->number . '/'), $filename);
            $validatedData['image'] = 'images/newsletter/'. $request->number . '/' . $filename;
        }

        $files = [];
        if ($request->has('file')) {
            foreach ($request->file('file') as $file) {
                $filename = $file->getClientOriginalName();
                $file->move(public_path('pdf/Newsletters/'. $request->number . '/'), $filename);
                $files[] = 'pdf/Newsletters/' . $request->number . '/' . $filename;
            }
        }

        $validatedData['file'] = implode(',', $files);

        $newsletter = new Newsletter;
        $newsletter->file = $validatedData['file'];
        $newsletter->image = $validatedData['image'];
        $newsletter->number = $request->number;
        $newsletter->created_at = now();
        $newsletter->updated_at = now();

        $newsletter->save();

        return redirect()->route('dashboard.newsletters.index', ['lang' => app()->getLocale()])
            ->with('status', 'newsletter created successfully.');
    }

    public function edit($lang, Newsletter $newsletter)
    {
        return view('dashboard.newsletters.newsletter-edit', compact('newsletter'));
    }

    public function update(Request $request, $lang, Newsletter $newsletter)
    {
        $request->validate([
            'number' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('images/newsletter/'. $request->number . '/'), $filename);
            $validatedData['image'] = 'images/newsletter/'. $request->number . '/' . $filename;
        }

        $existingFiles = explode(',', $newsletter->file);
        if ($request->has('file')) {
            $existingFiles = [];
            foreach ($request->file('file') as $file) {
                $filename = $file->getClientOriginalName();
                $file->move(public_path('pdf/Newsletters/'. $request->number .'/'), $filename);
                $existingFiles[] = 'pdf/Newsletters/' . $request->number . '/' . $filename;
            }
        }

        $newsletter->update();

        return redirect()->route('dashboard.newsletters.index', ['lang' => app()->getLocale()])
            ->with('status', 'newsletter updated successfully.');
    }

    public function destroy($lang, Newsletter $newsletter)
    {
        $newsletter->delete();

        return redirect()->route('dashboard.newsletters.index', ['lang' => app()->getLocale()])
            ->with('status', 'Newsletter deleted successfully.');
    }
}
