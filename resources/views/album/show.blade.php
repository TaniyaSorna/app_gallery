@extends('layouts.sideapp')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            {{-- <h5 class="card-title align-self-center mb-0">Photos</h5> --}}
            <a href="{{ route('photo.create', $album) }}" class="btn btn-sm btn-primary px-3 py-2">Add Photo</a>
            <a href="{{ route('album.index') }}" class="btn btn-sm btn-success px-lg-5 py-lg-2">Back</a>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($photos as $photo)
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{ asset($photo->photo_url) }}" alt=""
                                    style="width: 100%;height: 250px; object-fit:cover">
                                <div class="d-flex justify-content-between mt-3">
                                    <a href="" class="btn btn-sm btn-success">Download</a>
                                    <form action="{{ route('photo.destroy', $photo) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger px-3 ">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
