<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users_Albums extends Model
{
    protected $fillable = [
        'user_id',
        'album_id',
        'admin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
