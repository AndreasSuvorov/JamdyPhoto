<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Class Media
 * @package App\Models
 * @property int $id
 * @property int $album_id
 * @property string $filename
 * @property string $filetype
 * @property string $filesize
 */
class Media extends Model
{
    protected $table = 'media';
    protected $fillable = [
        'album_id',
        'filename',
        'filetype',
        'filesize'
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function getUrl($size = 'original') {
        if($size == 'original') {
            return Storage::url($this->filename);
        } else {
            $path = pathinfo($this->filename);
            $filename = $path['filename'] . '_' . $size . '.' . $path['extension'];
            return Storage::url($path['dirname'] . '/' . $filename);
        }

    }

}
