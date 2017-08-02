<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Podcast::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class)->lazy(),
        'title' => 'Example Podcast',
        'description' => 'An example podcast about examples.',
        'website' => 'http://example.com',
        'cover_path' => 'images/podcast-art/bike-shed.jpeg',
    ];
});

$factory->state(App\Podcast::class, 'published', function (Faker $faker) {
    return [
        'published_at' => $faker->dateTimeBetween('-4 years'),
    ];
});

$factory->define(App\Episode::class, function (Faker $faker) {
    return [
        'podcast_id' => factory(App\Podcast::class)->lazy(),
        "number" => 68,
        "title" => "68: Building Interfaces with Utility-First CSS",
        "url" => "http://www.fullstackradio.com/68",
        "content_text" => "In this episode, Adam welcomes back Jonathan Reinink to talk about implementing designs with a utility-first approach to CSS.\n\nThey talk about the problems this approach has solved for them, the surprising workflow benefits, and some tips and tricks for using this approach well.\n",
        "content_html" => "<p>In this episode, Adam welcomes back <a href=\"https://twitter.com/reinink\">Jonathan Reinink</a> to talk about implementing designs with a utility-first approach to CSS.</p>\n\n<p>They talk about the problems this approach has solved for them, the surprising workflow benefits, and some tips and tricks for using this approach well.</p>\n\n<p>Sponsors:</p>\n\n<ul>\n<li><a href=\"https://rollbar.com/fullstackradio\">Rollbar</a>, sign up at <a href=\"https://rollbar.com/fullstackradio\">https://rollbar.com/fullstackradio</a> to try their Bootstrap Plan free for 90 days</li>\n<li><a href=\"http://codeship.com/\">Codeship</a></li>\n</ul>\n\n\n<p>Links:</p>\n\n<ul>\n<li><a href=\"http://getbem.com/\">BEM</a>, the Block Element Modifier CSS methodology</li>\n<li><a href=\"http://nicolasgallagher.com/about-html-semantics-front-end-architecture/\">About HTML semantics and front-end architecture</a>, a blog post by Nicolas Gallagher that heavily inspired the way Adam writes CSS</li>\n<li><a href=\"https://www.youtube.com/watch?v=6EyPqf1Xh2U&amp;t=8s\">Implementing Designs with Utility-Focused CSS</a>, a recorded live stream where you can watch Adam implement a design using his work-in-progress CSS framework</li>\n<li><a href=\"http://buildwithbeard.com/\">Beard</a>, David Hemphill's utility framework</li>\n<li><a href=\"http://tachyons.io/\">Tachyons</a>, a popular utility framework</li>\n<li><a href=\"https://fractures.space/docs\">fractures</a> utility framework</li>\n<li><a href=\"http://turretcss.com/\">turrettcss</a> utility framework</li>\n</ul>\n\n",
        "download_url" => "http://audio.simplecast.com/77398.mp3",
        "duration" => 3863,
    ];
});

$factory->state(App\Episode::class, 'published', function (Faker $faker) {
    return [
        'published_at' => $faker->dateTimeBetween('-4 years'),
    ];
});
