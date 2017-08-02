<?php

namespace Tests\Feature;

use App\User;
use App\Podcast;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublishPodcastTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_publish_their_own_podcast()
    {
        $user = factory(User::class)->create();
        $podcast = factory(Podcast::class)->create([
            'user_id' => $user->id,
            'published_at' => null,
        ]);
        $this->assertFalse($podcast->isPublished());

        $response = $this->actingAs($user)->post("/podcasts/{$podcast->id}/publish");

        $response->assertSuccessful();
        $this->assertTrue($podcast->fresh()->isPublished());
    }

    /** @test */
    public function a_user_can_unpublish_their_own_podcast()
    {
        $user = factory(User::class)->create();
        $podcast = factory(Podcast::class)->create([
            'user_id' => $user->id,
            'published_at' => now(),
        ]);
        $this->assertTrue($podcast->isPublished());

        $response = $this->actingAs($user)->post("/podcasts/{$podcast->id}/unpublish");

        $response->assertSuccessful();
        $this->assertFalse($podcast->fresh()->isPublished());
    }
}
