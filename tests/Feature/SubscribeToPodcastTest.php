<?php

namespace Tests\Feature;

use App\User;
use App\Podcast;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscribeToPodcastTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_subscribe_to_a_published_podcast()
    {
        $user = factory(User::class)->create();
        $podcast = factory(Podcast::class)->states('published')->create();

        $response = $this->actingAs($user)->post("/podcasts/{$podcast->id}/subscribe");

        $response->assertSuccessful();
        $this->assertTrue($user->subscribedPodcasts->contains($podcast));
    }

    /** @test */
    public function a_user_can_unsubscribe_from_a_podcast()
    {
        $user = factory(User::class)->create();
        $podcast = factory(Podcast::class)->states('published')->create();
        $podcast->users()->attach($user);

        $response = $this->actingAs($user)->post("/podcasts/{$podcast->id}/unsubscribe");

        $response->assertSuccessful();
        $this->assertFalse($user->subscribedPodcasts->contains($podcast));
    }
}
