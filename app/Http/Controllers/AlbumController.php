<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Media;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function admin()
    {
        $params = \request()->all();

        $albums = Album::query()
            ->join('users_albums', 'users_albums.album_id', '=', 'albums.id')
            ->where('users_albums.user_id', '=', auth()->id())
            ->select('albums.*')
            ->get();

        if (isset($params['show'])) {
            if ($params['show'] == 'my') {
                $albums = Album::query()
                    ->join('users_albums', 'users_albums.album_id', '=', 'albums.id')
                    ->where('users_albums.user_id', '=', auth()->id())
                    ->where('users_albums.admin', 1)
                    ->select('albums.*')
                    ->get();
            } else if ($params['show'] == 'visited') {
                $albums = Album::query()
                    ->join('users_albums', 'users_albums.album_id', '=', 'albums.id')
                    ->where('users_albums.user_id', '=', auth()->id())
                    ->where('users_albums.admin', 0)
                    ->select('albums.*')
                    ->get();
            } else {
                $albums = Album::query()
                    ->join('users_albums', 'users_albums.album_id', '=', 'albums.id')
                    ->where('users_albums.user_id', '=', auth()->id())
                    ->select('albums.*')
                    ->get();
            }
        }


        return view('admin.album.index',
            [
                'albums' => $albums ?? []
            ]
        );

    }

    public function edit($id = null)
    {

        if ($id) {
            $album = Album::query()->find($id);
        }

        return view('admin.album.edit', [
                'updateUrl' => $id ? route('album.update', ['id' => $id]) : route('album.create'),
                'album' => $album ?? null
            ]
        );
    }

    public function create()
    {
        $params = \request()->all();

        $attributes = $this->getAttributes($params);

        // Create a 10 Long Unique ID for the Album and check if the ID already exists
        do {
            $attributes['uuid'] = substr(md5(uniqid()), 0, 10);
        } while (Album::query()->where('uuid', $attributes['uuid'])->exists());


        $album = Album::create($attributes);
        $album->users()->attach(auth()->id(), ['admin' => 1]);
        $album->save();
        return redirect()->route('album.edit', ['id' => $album->id]);
    }

    public function update(int $id): RedirectResponse
    {
        $params = \request()->all();
        $album = Album::query()->find($id);
        $attributes = $this->getAttributes($params);
        $album->update($attributes);
        return redirect()->route('album.edit', ['id' => $album->id])
            ->with('success', 'your message,here');
    }

    public function show(string $uuid)
    {

        return view('admin.album.show', [
            'album' => Album::query()->where('uuid', $uuid)->first()
        ]);
    }

    public function uploadMedia(Request $request, $id)
    {
        $request->validate([
            'media.*' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi,flv|max:20480',
        ]);

        $album = Album::findOrFail($id);
        $files = $request->file('media');

        foreach ($files as $file) {
            $path = $file->store('media', 'public');

            $media = new Media();
            $media->album_id = $album->id;
            $media->filename = $path;
            $media->filetype = $file->getClientMimeType();
            $media->filesize = $file->getSize();
            $media->save();
        }

        return response()->json(['success' => true]);
    }

    public function downloadMedia($id)
    {
        $album = Album::findOrFail($id);
        $allMedias= $album->media;

        // Make all to Zip File and Download it
        $zip = new \ZipArchive();
        $zipFileName = 'album-'.$album->uuid.'.zip';
        $zip->open(storage_path('app/public/'.$zipFileName), \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        foreach ($allMedias as $media) {
            $zip->addFile(storage_path('app/public/' . $media->filename), $media->filename);
        }
        $zip->close();
        return response()->download(storage_path('app/public/' . $zipFileName));
    }

    private function getAttributes($params)
    {

        return [
            'title' => $params['title'],
            'slug' => '',
            'description' => $params['description'],
            'location' => $params['location'],
            'start_date' => $params['start_date'],
            'end_date' => $params['end_date'],
            'active' => $this->getCheckboxValue($params, 'active'),
            'upload_active' => $this->getCheckboxValue($params, 'upload_active'),
            'download_active' => $this->getCheckboxValue($params, 'download_active'),
            'password_active' => $this->getCheckboxValue($params, 'password_active'),
            'password' => $params['password'] ?? null,
            'show_hero_image' => $this->getCheckboxValue($params, 'show_hero_image'),
            'sort_by' => $params['sort_by'] ?? 'created_at',
            'sort_order' => $params['sort_order'] ?? 'desc',
            'images_without_verification' => $this->getCheckboxValue($params, 'images_without_verification'),

        ];
    }

    private function getCheckboxValue($params, $key)
    {
        return isset($params[$key]) ? 1 : 0;
    }
}
