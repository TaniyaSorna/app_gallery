@extends('layouts.sideapp')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title align-self-center mb-0">Upload Album Photo</h5>
            <a href="{{ route('album.show', $album->id) }}" class="btn btn-sm btn-primary px-lg-5 py-lg-2">Back</a>
        </div>
        <form action="{{ route('photo.store', $album->id) }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-lg-3">
                <input type="hidden" name="album_id" value="{{ $album->id }}">
                <label for="">Uploade Photo</label>
                <input type="file" name="photos[]" class="form-control" multiple>
            </div>
            <button type="submit" class="btn btn-sm btn-primary px-lg-5 py-lg-2">Create</button>
        </form>
    </div>
@endsection
