@extends('layouts.sideapp')
@section('content')
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="m-0">Albums</h2>
        <a href="{{ route('album.create') }}" class="btn btn-sm btn-primary px-lg-5 py-lg-2">Add New</a>
    </div>
    <div class="row">
        @foreach ($data as $item)
            <div class="card col-lg-3">
                <div class="card-header">
                    <img src="{{ $item->coverImg }}" class="card-img-top object-fit-cover" alt="" width="200px"
                        height="200px">
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $item->name }}</h5>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('album.show', $item->id) }}" class="btn btn-sm btn-primary px-lg-3">View</a>
                    <a href="{{ route('album.edit', $item->id) }}" class="btn btn-sm btn-success px-lg-3">Edit</a>
                    <form action="{{ route('album.destroy', $item->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
