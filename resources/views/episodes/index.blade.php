@extends('layouts.app')

@section('body')
<div class="container mt-6">
    <div class="constrain-xl mx-auto">
        <h1 class="mb-6">Latest Episodes</h1>
        @foreach ($episodes as $episode)
        <div class="row pull-x-4 mb-6">
            <div class="col-3 px-4">
                <div class="block box-shadow">
                    <a href="{{ url("/podcasts/{$episode->podcast->id}") }}">
                        <img src="{{ $episode->podcast->imageUrl() }}" class="img-fit">
                    </a>
                </div>
            </div>
            <div class="col-9 px-4 pt-4">
                <div class="mb-4">
                    <p class="text-spaced text-uppercase text-medium text-dark-softest text-sm">{{ $episode->published_at->format('j M Y')}}</p>
                    <h2 class="text-lg text-ellipsis">
                        <a href="{{ url("/episodes/{$episode->id}") }}" class="text-bold">
                            {{ $episode->title }}
                        </a>
                    </h2>
                    <p class="text-sm text-uppercase text-spaced text-ellipsis">
                        <a href="{{ url("/podcasts/{$episode->podcast->id}") }}" class="link-softer text-medium">
                            {{ $episode->podcast->title }}
                        </a>
                    </p>
                </div>
                <audio class="block full-width mb-5" controls preload="metadata">
                    <source src="{{ $episode->download_url }}" type="audio/mpeg">
                </audio>
            </div>
        </div>
        @endforeach
    </div>
    <div class="text-center">
        {{ $episodes->links() }}
    </div>
</div>
@endsection
