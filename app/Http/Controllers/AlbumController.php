<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Album::get();
        return view('album.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('album.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'coverImg' => 'required|image|mimes:png,jpg,jpeg,webp,svg,gif',
        ]);
        $name = $request->name;

        if ($request->hasFile('coverImg')) {
            $img = $request->file('coverImg');
            $img_name = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('uploads/coverImages'), $img_name);
            $img_url = 'uploads/coverImages/' . $img_name;
        }
        Album::create([
            'name' => $name,
            'coverImg' => $img_url
        ]);
        return redirect()->route('album.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        $photos = $album->photos()->latest()->get();
        return view('album.show', compact('album', 'photos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        return view('album.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        $request->validate([
            'name' => 'string',
            'coverImg' => 'image|mimes:png,jpg,jpeg,webp,svg,gif',
        ]);

        $name = $request->name;

        if ($request->hasFile('coverImg')) {

            $old_coverImg = $album->coverImg;
            File::delete($old_coverImg);

            $img = $request->file('coverImg');
            $img_name = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('uploads/coverImages'), $img_name);
            $img_url = 'uploads/coverImages/' . $img_name;

            $album->update([
                'name' => $name,
                'coverImg' => $img_url
            ]);
        }

        $album->update([
            'name' => $name
        ]);
        return redirect()->route('album.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        $coverImg = $album->coverImg;
        if (file($coverImg)) {
            $album->delete();
            File::delete($coverImg);
        }
        return redirect()->route('album.index');
    }
}
