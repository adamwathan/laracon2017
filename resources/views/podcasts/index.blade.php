@extends('layouts.app')

@section('body')
    <div class="bg-circuit mb-6 border-t border-b border-dark-softer">
        <div class="container">
            <div class="py-9">
                <h1 class="text-3xl">Podcasting for Programmers</h1>
                <p class="text-2xl text-thin text-dark-soft">The best place to discover and publish podcasts about building software.</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div>
            <h1 class="text-bold mb-4">Popular Shows</h1>
            <div class="row pull-x-4 pull-b-6">
                @foreach ($podcasts as $podcast)
                <div class="col-2 px-4 mb-6">
                    <div class="hover-grow">
                        <a href="{{ url("/podcasts/{$podcast->id}") }}" class="block box-shadow mb-2">
                            <img src="{{ $podcast->imageUrl() }}" class="img-fit">
                        </a>
                        <p class="text-ellipsis">
                            <a href="{{ url("/podcasts/{$podcast->id}") }}" class="text-sm text-medium">
                                {{ $podcast->title }}
                            </a>
                        </p>
                        <p class="text-xs text-uppercase text-spaced text-ellipsis">
                            <a href="{{ $podcast->website }}" class="link-softer">
                                {{ $podcast->websiteHost() }}
                            </a>
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
