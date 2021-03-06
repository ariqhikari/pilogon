@extends('landing_page.master')

@push('addon-meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section("title","Buat Article - Pilogon")

@section('logo')
    <img src="{{ asset("resource/image/logo tulisan.png") }}" alt="" width="130px" style="margin-top: -10px;margin-left:30px"
    >
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        body{
            background-color: #f2f2f2;
        }

        .btn-registrasi{
            width: 125px;
            height: 30px;
            border-radius: 40px;
            border: none;
            background-color: #f2f2f2;
            color: #262C39;
            font-size: 20px;
        }

        .btn-login{
            background-color: transparent;
            width: 85px;
            height: 30px;
            border-radius: 40px;
            color: #f2f2f2;
            border: solid 2px #f2f2f2;
            font-size: 20px;
        }
    

        #logo-nav{
            color: #262C39
        }

        ::-webkit-scrollbar-thumb {
            background-color: #262C39;
        }

        #logo-down{
            color: #262C39
        }

        .sidenav{
            background-color: #262C39;
        }

        .sidenav a{
            color: #f7f7f7
        }
    </style>
@endsection

@section('content')
    <div class="container" style="clear: both">
        <form action="{{ route("blogs.store") }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card box-profile">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="my-input" class="form-control @error("title") is-invalid @enderror" type="text" placeholder="Judul" name="title" value="{{ old("title") }}">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="category_id" class="form-control @error("category_id") is-invalid @enderror" id="">
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($categorys as $item)
                                                <option value="{{ $item->id }}" {{ (old("category_id") == $item->id) ? "selected" : "" }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="content" id="desc" class="form-control @error("content") is-invalid @enderror" cols="30" rows="10">{{ old("content") }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="file" name="thumbnail" class="form-control @error("thumbnail") is-invalid @enderror">
                                        @error('thumbnail')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" style="background: #262C39" class="btn btn-dark btn-block">Buat Article</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    @include('includes.summernote')
@endsection
