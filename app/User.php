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
        return $this->belongsToMany(Podcast::class)->withTimestamps();
    }

    public function subscribesTo($podcast)
    {
        return $this->subscribedPodcasts()->where($podcast->getQualifiedKeyName(), $podcast->getKey())->count() > 0;
    }
}
