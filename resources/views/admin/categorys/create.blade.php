@extends('templates_backend.home')

@section("title","Create Categorys")

@section("sub-title","Create Categorys")

@section('content')
    <form action="{{ route("categorys.store") }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name :</label>
            <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="gambar">Image :</label>
            <input id="gambar" class="form-control @error('gambar') is-invalid @enderror" type="file" name="gambar">
            @error('gambar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block">Create Category</button>
    </form>
@endsection