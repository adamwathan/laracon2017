@extends('layouts.app')

@section('body')
    <div class="container mt-6">
        <div class="row pull-x-4">
            <div class="col-3 px-4">
                <div class="block box-shadow mb-4">
                    <a href="{{ url("/podcasts/{$episode->podcast->id}") }}">
                        <img src="{{ $episode->podcast->imageUrl() }}" class="img-fit">
                    </a>
                </div>
            </div>
            <div class="col-9 px-4">
                <div class="mb-6">
                    <div class="flex-spaced flex-y-center mb-5">
                        <div>
                            <p class="text-spaced text-uppercase text-medium text-dark-softest text-sm">{{ $episode->published_at->format('j M Y')}}</p>
                            <h1 class="leading-none mb-2">{{ $episode->title }}</h1>
                            <p class="text-sm text-uppercase text-spaced text-ellipsis">
                                <a href="{{ url("/podcasts/{$episode->podcast->id}") }}" class="link-softer text-medium">
                                    {{ $episode->podcast->title }}
                                </a>
                            </p>
                        </div>
                    </div>
                    <audio class="block full-width mb-5" controls preload="metadata">
                        <source src="{{ $episode->download_url }}" type="audio/mpeg">
                    </audio>
                    <div class="markdown">
                        {!! $episode->content_html !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
