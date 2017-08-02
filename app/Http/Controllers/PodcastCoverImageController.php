<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PodcastCoverImageController extends Controller
{
    public function update($id)
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
}
