<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }

    public function setUserAttribute($user)
    {
        $this->user_id = $user->getKey();
        $this->setRelation('user', $user);
    }

    public function setPodcastAttribute($podcast)
    {
        $this->podcast_id = $podcast->getKey();
        $this->setRelation('podcast', $podcast);
    }
}
