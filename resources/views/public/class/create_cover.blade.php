@extends('landing_page.master')

@push('addon-meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section("title","Buat Kelas - Pilogon")

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
        <div class="row text-center justify-content-center">
            <div class="col-md-10">
                <h2>Bagaimana Cara Membuat Kelasmu Sendiri</h2>
                <p style="color: #666666">Ikuti langkah-langkah dibawah untuk membuat dan mengupload kelasmu sendiri di situs ini, pastikan tidak ada yang terlewat ataupun salah.</p>
            </div>
        </div>
        <div class="row mt-2 justify-content-center">
            <div class="col-md-4" id="crs-hwt1">
                <div class="card box-profile">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <h5 class="card-title">Buat Cover Kelas</h5>
                                <p class="card-text" style="color: #666666">Pertama buatlah cover kelasmu.</p>
                            </div>
                            <div class="col-md-5 text-center">
                                <img src="{{ asset("resource/image/crs1.png") }}" class="img-crs" width="100%" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" id="crs-hwt2">
                <div class="card box-profile">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <h5 class="card-title">Tambahkan Modul</h5>
                                <p class="card-text" style="color: #666666">Kedua isikan modul atau materi di kelas yang sudah dibuat.</p>
                            </div>
                            <div class="col-md-5 text-center">
                                <img src="{{ asset("resource/image/crs2.png") }}" class="img-crs" width="100%" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card box-profile">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <h5 class="card-title">Publikasikan</h5>
                                <p class="card-text" style="color: #666666">Terakhir verifikasi kelas untuk mendapatkan persetujuan admin.</p>
                            </div>
                            <div class="col-md-5 text-center">
                                <img src="{{ asset("resource/image/crs1.png") }}" class="img-crs" width="100%" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card box-profile">
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col">
                                <h4>Buat Cover Kelasmu Disini</h4>
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <form action="{{ route("class.store_cover") }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <img src="{{ asset('resource/image/thumbnail.jpg') }}" alt="" width="100%" height="200px" style="border: solid rgb(194, 194, 194); border-radius:5px">
                                        <input id="my-input" class="form-control mt-3 @error('thumbnail') is-invalid @enderror" type="file" name="thumbnail" style="background-color: transparent">
                                        @error('thumbnail')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                            </div>
                            <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="title">Judul : </label>
                                        <input id="title" class="form-control @error('title') is-invalid @enderror" type="text" name="title" style="background-color: transparent" value="{{ old('title') }}">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="level">Level : </label>
                                        <select name="level" class="form-control @error('level') is-invalid @enderror" id="" style="background-color: transparent">
                                            <option value="">Pilih Level</option>
                                            <option value="beginner" {{ (old("level") == "beginner") ? "selected" : '' }}>Beginner</option>
                                            <option value="intermediate" {{ (old("level") == "intermediate") ? "selected" : '' }}>Intermediate</option>
                                            <option value="professional" {{ (old("level") == "professional") ? "selected" : '' }}>Professional</option>
                                        </select>
                                        @error('level')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="category_id">Kategori : </label>
                                        <select name="category_id[]" class="js-example-basic-multiple" multiple="multiple" class="form-control @error('category_id') is-invalid @enderror" id="" style="background-color: transparent;width:100%">
                                            @foreach ($categorys as $item)
                                                <option value="{{ $item->id }}" {{ (old("category_id") == $item->id) ? "selected" : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Deskripsi : </label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="desc" cols="30" rows="10">{{ old("description") }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block" style="border-radius: 5px;
                                    border: none;background-color: #262C39;color: #ffffff;font-size: 20px;">
                                        <i class="fas fa-save"></i> Buat Cover Kelas
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('includes.summernote')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                placeholder: "Pilih Kategori",
                allowClear: true
            });
        });
    </script>
@endsection