@extends('landing_page.master')

@section("title","ViewMore")

@section('logo')
    <img src="{{ asset("resource/image/logo_putih.png") }}" alt="" width="130px" style="margin-top: 30px;margin-left:30px"
    >
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset("blog/style.css") }}">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
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
            color: white
        }

        ::-webkit-scrollbar-thumb {
            background-color: #262C39;
        }

        #logo-down{
            color: white
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
    <div class="header" style="background-image: url('{{ asset("blog/img/bg.jpg") }}')">
        <div class="container text-center" style="clear:both">
            <h1 class="display-4" id="title-blog-head">Semua Artikel</h1>
            <p class="lead" id="sub-title-blog-head">Blog-blog terkait tutorial atau tips & trick pemrograman.</p>
            <a href="{{ route("blogs.create") }}">
                <button style="border: solid 2px white;background:transparent;color:white;border-radius:20px;width:130px;height:40px">Tulis Blog</button>
            </a>
            <center class="mt-4">
                <a href="#post" class="page-scroll">
                    <img src="{{ asset("blog/img/icons/icon_scroll.png") }}" alt="icon_scroll">
                </a>
            </center>
        </div>
    </div>

    <div class="container">
        <div class="col-md-12">
            <div class="row mt-4">
                @foreach ($posts as $item)
                <div class="col-md-6 col-lg-4 my-3">
                    <div class="card box-profile">
                        <a href="{{ route("blogs.show",$item) }}" class="text-decoration-none">
                            <center>
                                <img src="{{ asset("upload_image/$item->thumbnail") }}" alt="html" style="width:90%;border-radius:10px;margin-top:17px">
                            </center>
                        </a>
                        <div class="card-body">
                            <a href="{{ route("blogs.show",$item) }}" class="text-decoration-none">
                                <h5 class="card-title">
                                    {{ substr($item->title,0,20) }}....
                                </h5>
                            </a>
                            <h6 class="card-text">
                                {!! substr($item->content,0,70) !!}
                            </h6>
                            <div class="author d-flex mt-4 align-items-center">
                                <div class="author-img">
                                    <img src="{{ asset("upload_image") }}/{{ $item->user->foto }}" alt="author" width="50px" height="50px" class="rounded-circle">
                                </div>
                                <div class="author-name ml-3">
                                    <p class="m-0"><a href="detail-post.html">{{ $item->user->name }}</a> in <a
                                            href="detail-post.html">{{ $item->category->name }}</a></p>
                                    <p class="m-0">{{ $item->created_at->diffForHumans() }} • 2 min read</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row justify-content-center text-center mt-3">
                <div class="col-md-3">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.page-scroll').on('click', function (e) {
            var tujuan = $(this).attr('href');
            var elemenTujuan = $(tujuan);
            $('html , body').animate({
                scrollTop: elemenTujuan.offset().top - 100
            });
            e.preventDefault();
        });
    </script>
@endsection