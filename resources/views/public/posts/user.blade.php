@extends('landing_page.master')

@section("title","Artikel Ku")

@section('logo')
    <img src="{{ asset("resource/image/logo tulisan.png") }}" alt="" width="130px" style="margin-top: -10px;margin-left:30px"
    >
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset("blog/style.css") }}">
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
            z-index:99
        }

        .sidenav a{
            color: #f7f7f7
        }
    </style>
@endsection

@section('content')
    <div class="container" style="clear: both">
        <div class="row justify-content-center text-center">
            <div class="col-md-5">
                <img src="{{ asset("resource/image/article.png") }}" style="margin-top: -20px" width="70%" alt="">  
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-md-8">
                <h3>Artikel Ku</h3>
                <h5 style="margin-top: -10px;color: #6d6d6d">{{ Auth::user()->name }}</h5>
            </div>
        </div>
        <div class="row justify-content-center text-center mt-3 mb-3">
            <div class="col-md-3">
                <h4>{{ Auth::user()->posts->count() }}</h4>
                <h5 style="color: #6d6d6d">Artikel</h5>
            </div>
            <div class="col-md-3">
                <h4>{{ Auth::user()->uploaded_post() }}</h4>
                <h5 style="color: #6d6d6d">Terupload</h5>
            </div>
            <div class="col-md-3">
                <h4>{{ Auth::user()->drafted_post() }}</h4>
                <h5 style="color: #6d6d6d">Draf</h5>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($posts as $item)
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card box-profile">
                                <div class="card-body">
                                    <img src="{{ Storage::url($item->thumbnail) }}" alt="" width="80px" style="border-radius:5px;float:left;margin-right:20px" height="80px">
                                    <h5 style="margin-top: 12px">{{ $item->title }}</h5>
                                    @if ($item->status != 1)
                                        <h6 style="color: #6d6d6d">Draft • {{ $item->created_at->format("d M") }}</h6>
                                    @else
                                        <h6 style="color: #6d6d6d">Dipublikasikan • {{ $item->created_at->format("d M") }}</h6>
                                    @endif
                                    <!-- Default dropright button -->
                                    <div class="btn-group dropright float-right" style="margin-top: -65px">
                                        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border:none;background:transparent">
                                            <i class="fas fa-ellipsis-v" style="font-size: 20px;color:rgb(88, 88, 88)"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <div style="margin-left: 20px;margin-top:7px">
                                                @if ($item->status != 1)
                                                    <a href="{{ route("blogs.upload",$item) }}">
                                                        <h6 style="color: #474747"><i class="fas fa-upload" ></i> Publish</h6>
                                                    </a>
                                                @else
                                                    <a href="{{ route("blogs.draft",$item) }}">
                                                        <h6 style="color: #474747"><i class="fas fa-upload" style="transform: rotate(180deg)"></i> Draft</h6>
                                                    </a>
                                                @endif
                                                <a href="{{ route("blogs.edit",$item) }}">
                                                    <h6 style="color: #474747"><i class="fas fa-edit"></i> Edit</h6>
                                                </a>
                                                <h6 style="color: #474747;cursor:pointer" onclick="confirmDelete({{ $item->id }})"><i class="fas fa-trash"></i> Hapus</h6>
                                                <a href="{{ route("blogs.preview",$item) }}">
                                                    <h6 style="color: #474747"><i class="fas fa-eye"></i> Preview</h6>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <i class="fas fa-comment-alt float-right" style="margin-top: -20px;color:rgb(88, 88, 88)"> {{ $item->comments->count() }}</i>
                                    <i class="fas fa-eye float-right" style="margin-right:50px;margin-top: -20px;color:rgb(88, 88, 88)"> {{ $item->views->count() }}</i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function confirmDelete(id) {
            swal({
                title: "Kamu Yakin?",
                text: "Menghapus Blog",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/blogs/"+ id +"/hapus-blog"
                } else {
                    swal("Data Kamu Aman");
                }
                });
        }
    </script>
@endsection