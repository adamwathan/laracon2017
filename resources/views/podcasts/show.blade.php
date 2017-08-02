@extends('layouts.app')

@section('body')
    <div class="container mt-6">
        <div class="row pull-x-4">
            <div class="col-3 px-4">
                <div class="block box-shadow mb-4">
                    <a href="{{ url("/podcasts/{$podcast->id}") }}">
                        <img src="{{ $podcast->imageUrl() }}" class="img-fit">
                    </a>
                </div>
            </div>
            <div class="col-9 px-4">
                <div class="mb-6">
                    <div class="flex-spaced flex-y-center mb-4">
                        <div>
                            <h1>
                                <a href="{{ url("/podcasts/{$podcast->id}") }}" class="text-bold">{{ $podcast->title }}</a>
                            </h1>
                            <p class="text-sm text-uppercase text-spaced text-ellipsis">
                                <a href="{{ $podcast->website }}" class="link-softer text-medium">
                                    {{ $podcast->websiteHost() }}
                                </a>
                            </p>
                        </div>
                        <div class="">
                            @if ($podcast->isOwnedBy(Auth::user()))
                                <publish-button :data-podcast="{{ $podcast }}" class="mr-2"></publish-button>
                                <a href="{{ url("/podcasts/{$podcast->id}/edit") }}" class="btn btn-sm btn-secondary">
                                    Settings
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="mb-4">
                        <subscribe-button
                            :data-subscription="{{ json_encode(Auth::user()->subscriptionTo($podcast)) }}"
                            :podcast="{{ $podcast }}"
                        ></subscribe-button>
                    </div>
                    <p class="text-dark-soft">{{ $podcast->description }}</p>
                </div>
                @if (count($episodes) > 0)
                    <div>
                        <div class="flex flex-y-baseline mb-4">
                            <h2 class="text-lg mr-4">Recent Episodes</h2>
                            <a href="{{ url("/podcasts/{$podcast->id}/episodes") }}" class="link-brand">View all</a>
                        </div>
                        <div class="text-sm">
                        @foreach ($podcast->episodes->sortByDesc('number')->take(5) as $episode)
                            <div class="border-t flex flex-y-baseline">
                                <div style="flex: 0 0 3rem;" class="text-no-wrap pr-4 text-right text-dark-softest py-3">{{ $episode->number }}</div>
                                <div class="text-ellipsis flex-fill">
                                    <a href="{{ url("/episodes/{$episode->id}") }}">{{ $episode->title }}</a>
                                </div>
                                <div style="flex: 0 0 6rem;" class="text-no-wrap text-dark-softer pr-4 text-right">
                                    {{ $episode->durationForHumans() }}
                                </div>
                                <div style="flex: 0 0 6.5rem;" class="text-no-wrap text-dark-softer pr-4">
                                    {{ $episode->published_at->format('M j, Y') }}
                                </div>
                                <div style="flex: 0 0 4.5rem;" class="text-no-wrap text-right">
                                    <a href="{{ url("/episodes/{$episode->id}") }}" class="btn btn-xs btn-secondary">Listen</a>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                @else
                    <div class="text-center py-6 text-dark-soft text-lg">
                        This podcast hasn't published any episodes yet.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
