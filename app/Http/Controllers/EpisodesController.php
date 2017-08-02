<?php

namespace App\Http\Controllers;

use App\Episode;
use Illuminate\Support\Facades\Auth;

class EpisodesController extends Controller
{
    public function index()
    {
        $episodes = Episode::with('podcast')->recent()->paginate(25);

        return view('episodes.index', [
            'episodes' => $episodes,
        ]);
    }

    public function show($id)
    {
        $episode = Episode::with('podcast')->findOrFail($id);

        abort_unless($episode->isVisibleTo(Auth::user()), 404);

        return view('episodes.show', [
            'episode' => $episode,
        ]);
    }

    public function edit($id)
    {
        $episode = Episode::with('podcast')->findOrFail($id);

        abort_unless($episode->isEditableBy(Auth::user()), 404);

        return view('episodes.edit', [
            'episode' => $episode
        ]);
    }

    public function update($id)
    {
        $episode = Episode::with('podcast')->findOrFail($id);

        abort_unless($episode->isEditableBy(Auth::user()), 404);

        request()->validate([
            'title' => ['required', 'max:150'],
            'description' => ['max:500'],
            'download_url' => ['required', 'url'],
        ]);

        $episode->update(request([
            'title',
            'description',
            'download_url',
        ]));

        return redirect("/episodes/{$episode->id}");
    }
}
