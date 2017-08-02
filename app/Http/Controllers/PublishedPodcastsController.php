<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublishedPodcastsController extends Controller
{
    public function store()
    {
        $podcast = Auth::user()->podcasts()->findOrFail(request('podcast_id'));

        $podcast->publish();

        return $podcast;
    }

    public function destroy($id)
    {
        $podcast = Auth::user()->podcasts()->findOrFail($id);

        $podcast->unpublish();

        return $podcast;
    }
}
