<?php

namespace App\Http\Controllers;

use App\Podcast;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PodcastsController extends Controller
{
    public function index()
    {
        $podcasts = Podcast::published()->paginate(24);

        return view('podcasts.index', [
            'podcasts' => $podcasts,
        ]);
    }

    public function create()
    {
        return view('podcasts.create');
    }

    public function store()
    {
        request()->validate([
            'title' => ['required', 'max:150'],
            'description' => ['max:500'],
            'website' => ['url'],
        ]);

        $podcast = Auth::user()->podcasts()->create(request([
            'title',
            'description',
            'website',
        ]));

        return redirect("/podcasts/{$podcast->id}");
    }

    public function show($id)
    {
        $podcast = Podcast::findOrFail($id);

        abort_unless($podcast->isVisibleTo(Auth::user()), 404);

        return view('podcasts.show', [
            'podcast' => $podcast,
            'episodes' => $podcast->recentEpisodes(5),
        ]);
    }

    public function edit($id)
    {
        $podcast = Auth::user()->podcasts()->findOrFail($id);

        return view('podcasts.edit', [
            'podcast' => $podcast,
        ]);
    }

    public function update($id)
    {
        $podcast = Auth::user()->podcasts()->findOrFail($id);

        request()->validate([
            'title' => ['required', 'max:150'],
            'description' => ['max:500'],
            'website' => ['url'],
        ]);

        $podcast->update(request([
            'title',
            'description',
            'website',
        ]));

        return redirect("/podcasts/{$podcast->id}");
    }

    public function destroy($id)
    {
        $podcast = Auth::user()->podcasts()->findOrFail($id);

        $podcast->delete();

        return redirect("/podcasts");
    }

    public function listEpisodes($id)
    {
        $podcast = Podcast::with('episodes')->findOrFail($id);

        abort_unless($podcast->isVisibleTo(Auth::user()), 404);

        return view('podcasts.list-episodes', [
            'podcast' => $podcast,
        ]);
    }

    public function updateCoverImage($id)
    {
        $podcast = Auth::user()->podcasts()->findOrFail($id);

        request()->validate([
            'cover_image' => ['required', 'image', Rule::dimensions()->minHeight(500), Rule::dimensions()->minWidth(500)],
        ]);

        $podcast->update([
            'cover_path' => request()->file('cover_image')->store('images', 'public'),
        ]);

        return redirect("/podcasts/{$podcast->id}");
    }

    public function subscribe($id)
    {
        $podcast = Podcast::published()->findOrFail($id);

        $podcast->users()->attach(Auth::user());

        return response('', 204);
    }

    public function unsubscribe($id)
    {
        $podcast = Podcast::findOrFail($id);

        $podcast->users()->detach(Auth::user());

        return response('', 204);
    }

    public function publish($id)
    {
        $podcast = Auth::user()->podcasts()->findOrFail($id);

        $podcast->publish();

        return response('', 204);
    }

    public function unpublish($id)
    {
        $podcast = Auth::user()->podcasts()->findOrFail($id);

        $podcast->unpublish();

        return response('', 204);
    }
}
