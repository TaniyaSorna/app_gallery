<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function create($album_id)
    {
        $album = Album::find($album_id);
        return view('photos.create', compact('album'));
    }
    public function store(Request $request, $album_id)
    {

        // if ($request->file('photos')) {
        //     dd('ss');
        // }
        // dd('ss');
        $request->validate([
            'album_id' => 'required',
            'photo_url.*' => 'required|image|mimes:png,jpg,jpeg,svg,gif'
        ]);

        // dd($request->all());

        // $album_id = $request->input('id');
        if ($request->hasFile('photos')) {
            // dd('hh');
            $img = $request->file('photos');
            // dd($img);
            foreach ($img as $photo) {

                $photo_name = md5(uniqid()) . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('uploads/album/photo'), $photo_name);
                $photo_url = 'uploads/album/photo/' . $photo_name;
            }

            // $img_name = time() . '.' . $img->getClientOriginalExtension();
            // $img->move(public_path('uploads/album/photo'), $img_name);
            // $img_url = 'uploads/album/photo/' . $img_name;
            Photo::create([
                'album_id' => $request->album_id,
                'photo_url' => $photo_url
            ]);
        }
        // Photo::create([
        //     'album_id' => $album_id,
        //     'photo_url' => $img_url
        // ]);
        return redirect()->route('album.show', $album_id);
    }


    public function destroy(Photo $photo)
    {
        // dd($photos);
        $album_id = $photo->album_id;
        // dd($album_id);
        unlink($photo->photo_url);
        $photo->delete();
        return redirect()->route('album.show', ['album' => $album_id]);
    }
}
