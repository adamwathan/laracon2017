<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function podcasts()
    {
        return $this->hasMany(Podcast::class);
    }

    public function subscribedPodcasts()
    {
        return $this->belongsToMany(Podcast::class, 'subscriptions')->withTimestamps();
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function subscribesTo($podcast)
    {
        return $this->subscribedPodcasts()->where($podcast->getQualifiedKeyName(), $podcast->getKey())->count() > 0;
    }

    public function subscriptionTo($podcast)
    {
        return $this->subscriptions()->where('podcast_id', $podcast->id)->first();
    }
}
