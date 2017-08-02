<?php

namespace App\Http\Controllers;

use App\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PodcastEpisodesController extends Controller
{
    public function index($id)
    {
        $podcast = Podcast::with('episodes')->findOrFail($id);

        abort_unless($podcast->isVisibleTo(Auth::user()), 404);

        return view('podcast-episodes.index', [
            'podcast' => $podcast,
        ]);
    }

    public function create($id)
    {
        $podcast = Auth::user()->podcasts()->findOrFail($id);

        return view('podcast-episodes.create', ['podcast' => $podcast]);
    }

    public function store($id)
    {
        $podcast = Auth::user()->podcasts()->findOrFail($id);

        request()->validate([
            'title' => ['required', 'max:150'],
            'description' => ['max:500'],
            'download_url' => ['required', 'url'],
        ]);

        $episode = $podcast->episodes()->create(request([
            'title',
            'description',
            'download_url',
        ]));

        return redirect("/episodes/{$episode->id}");
    }
}
