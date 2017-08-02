<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Podcast extends Model
{
    protected $guarded = [];
    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function publish()
    {
        $this->update(['published_at' => $this->freshTimestamp()]);
    }

    public function unpublish()
    {
        $this->update(['published_at' => null]);
    }

    public function recentEpisodes($count = 5)
    {
        return $this->episodes()->recent()->take($count)->get();
    }

    public function imageUrl()
    {
        return Storage::disk('public')->url($this->cover_path);
    }

    public function websiteHost()
    {
        return parse_url($this->website, PHP_URL_HOST);
    }

    public function isVisibleTo($user)
    {
        return $this->isPublished() || $this->isOwnedBy($user);
    }

    public function isPublished()
    {
        return $this->published_at !== null;
    }

    public function isOwnedBy($user)
    {
        return $this->user_id == $user->getKey();
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'cover_url' => $this->imageUrl(),
            'published' => $this->isPublished(),
            'subscribed' => auth()->user()->subscribesTo($this),
            'links' => [
                'publish' => url("/podcasts/{$this->id}/publish"),
                'unpublish' => url("/podcasts/{$this->id}/unpublish"),
                'subscribe' => url("/podcasts/{$this->id}/subscribe"),
                'unsubscribe' => url("/podcasts/{$this->id}/unsubscribe"),
                'update_cover_image' => url("/podcasts/{$this->id}/update-cover-image"),
            ],
        ]);
    }
}
