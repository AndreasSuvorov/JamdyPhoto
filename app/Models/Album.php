<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{

    protected $fillable = [
        'uuid',
        'title',
        'slug',
        'location',
        'description',
        'start_date',
        'end_date',
        'active',
        'upload_active',
        'download_active',
        'password_active',
        'password',
        'show_hero_image',
        'sort_by',
        'sort_order',
        'images_without_verification'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_albums');
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }


    public function cover(): string
    {
        if ($this->media->count() > 0) {
            return $this->media->random()->getUrl();

        } else {
            return asset('images/party.jpg');
        }
    }

    public function isDefaultImage(): bool
    {
        if ($this->media->count() > 0) {
            return false;

        }

        return true;
    }


}
