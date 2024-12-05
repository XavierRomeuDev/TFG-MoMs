<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{

    public function index()
    {
        $pills = Video::all();
        return view('dashboard.informative-pills.pills-list', compact('pills'));
    }

    public function videos()
    {
        $videos = Video::all();
        return view('informative-pills', compact('videos'));
    }

    public function create()
    {
        return view('dashboard.informative-pills.create-pill');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'url' => 'required|url',
        ]);

        // Extract YouTube video ID from the URL
        $url = $request->url;
        $videoId = $this->extractYoutubeVideoId($url);

        if (!$videoId) {
            return redirect()->back()->with('error', 'Invalid YouTube URL.');
        }

        // Create a new video instance
        $video = new Video([
            'title' => $request->title,
            'description' => $request->description,
            'url' => "https://www.youtube.com/embed/$videoId",
        ]);

        // Save the video to the database
        $video->save();

        return redirect()->route('dashboard.pills.index', ['lang' => app()->getLocale()])
                         ->with('status', 'Pill created successfully.');
    }

    private function extractYoutubeVideoId($url)
    {
        parse_str(parse_url($url, PHP_URL_QUERY), $queryParams);
        return $queryParams['v'] ?? null;
    }

    public function edit($lang, Video $pill)
    {
        return view('dashboard.informative-pills.pills-edit', compact('pill'));
    }

    public function update(Request $request, $lang, Video $pill)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        $url = $request->url;
        $videoId = $this->extractYoutubeVideoId($url);

        $pill->title = $request->input('title');
        $pill->url = "https://www.youtube.com/embed/$videoId";

        $pill->save();

        return redirect()->route('dashboard.pills.index', ['lang' => app()->getLocale()])
                         ->with('status', 'Tag created successfully.');
    }

    public function destroy($lang, Video $pill)
    {
        $pill->delete();
    
        return redirect()->route('dashboard.pills.index', ['lang' => $lang])
                         ->with('status', 'Tag created successfully.');
    }
    

}
