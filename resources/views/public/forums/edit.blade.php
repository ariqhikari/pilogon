@extends('landing_page.master')

@push('addon-meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section("title","Edit Forum - Pilogon")

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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center mb-4 mt-4">
                    Buat Pertanyaan
                </h1>
                <div class="card box-profile">
                    <div class="card-body">
                        <form action="{{ route("forum.update",$forum) }}" method="post">
                            @csrf
                            @method("patch")

                            <div class="form-group">
                                <input id="title" class="form-control @error("title") is-invalid @enderror" type="text" name="title" value="{{ $forum->title }}" placeholder="Judul Disini, Contoh: Controller Laravel atau semacamnya">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <textarea name="question" class="form-control @error('question') is-invalid @enderror" id="desc" cols="30" rows="10">{{ $forum->problem }}</textarea>
                                @error('question')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select name="category_id[]" class="js-example-basic-multiple" multiple="multiple" class="form-control @error('category_id') is-invalid @enderror" id="" style="background-color: transparent;width:100%">
                                    @foreach ($categorys as $item)
                                        <option value="{{ $item->id }}" 
                                            @foreach ($forum->categorys as $item2)
                                                @if ($item2->id == $item->id)
                                                    selected
                                                @endif
                                            @endforeach
                                        >{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-dark btn-block" style="background-color: #262C39">Edit Pertanyaan</button>
                        </form>
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
