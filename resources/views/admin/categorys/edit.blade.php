@extends('templates_backend.home')

@section("title","Edit $category->name")

@section("sub-title","Edit $category->name")

@section('content')
    <form action="{{ route("categorys.update",$category) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("patch")
        <div class="form-group">
            <label for="name">Name :</label>
            <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ $category->name }}">
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
        <button type="submit" class="btn btn-primary btn-block">Edit Category</button>
    </form>
@endsection