<?php

namespace App\Http\Controllers;

use App\Models\ResearchBook;
use Illuminate\Http\Request;

class ResearchBookController extends Controller
{
    /**
     * Display a listing of the partners.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $research = ResearchBook::all();

        return view('dashboard.research-book.research-list', ['research' => $research]);
    }

    public function research()
    {
        $research = ResearchBook::all();
        return view('research-book', compact('research'));
    }

    public function create()
    {
        return view('dashboard.research-book.research-create');
    }

    public function store(Request $request)
    {
        $files = [];
        if ($request->has('file')) {
            foreach ($request->file('file') as $file) {
                $filename = $file->getClientOriginalName();
                $file->move(public_path('pdf/Research Book/'), $filename);
                $files[] = 'pdf/Research Book/' . $filename;
            }
        }

        $validatedData['file'] = implode(',', $files);

        $research = new ResearchBook();
        $research->file = $validatedData['file'];
        $research->created_at = now();
        $research->updated_at = now();

        $research->save();

        return redirect()->route('dashboard.research-book.index', ['lang' => app()->getLocale()])
            ->with('status', 'Research Book created successfully.');
    }

    public function edit($lang, ResearchBook $research)
    {
        return view('dashboard.research-book.research-edit', compact('research'));
    }

    public function update(Request $request, $lang, ResearchBook $research)
    {
        $existingFiles = explode(',', $research->file);
        if ($request->has('file')) {
            $existingFiles = [];
            foreach ($request->file('file') as $file) {
                $filename = $file->getClientOriginalName();
                $file->move(public_path('pdf/Research Book/'), $filename);
                $existingFiles[] = 'pdf/Research Book/'. $filename;
            }
        }

        $validatedData['file'] = implode(',', $existingFiles);

        $research->file = $validatedData['file'];
        $research->updated_at = now();
        $research->save();

        return redirect()->route('dashboard.research-book.index', ['lang' => app()->getLocale()])
            ->with('status', 'Research Book updated successfully.');
    }

    public function destroy($lang, ResearchBook $research)
    {
        $research->delete();

        return redirect()->route('dashboard.research-book.index', ['lang' => app()->getLocale()])
            ->with('status', 'Research Book deleted successfully.');
    }
}
