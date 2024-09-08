@extends('layouts.sideapp')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="m-0">Albums</h2>
            <a href="{{ route('album.index') }}" class="btn btn-sm btn-primary px-lg-5 py-lg-2">Back</a>
        </div>
        <form action="{{ route('album.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-lg-3">
                <label for="">Album Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="mb-lg-3">
                <label for="">Uploade CoverImg</label>
                <input type="file" name="coverImg" class="form-control">
            </div>
            <button type="submit" class="btn btn-sm btn-primary px-lg-5 py-lg-2">Create</button>
        </form>
    </div>
@endsection
