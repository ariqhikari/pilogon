@extends('landing_page.master')

@section("title","$blog->title - Pilogon")

@section('logo')
    <img src="{{ asset("resource/image/logo_putih.png") }}" alt="" width="130px" style="margin-top: -10px;margin-left:30px"
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
    <div class="jumbotron">
        <div class="container mt-5" style="clear:both;padding-top:80px"">
            <h1 class="display-4">{{ $blog->title }}</h1>
            <div class="author mt-4 d-flex align-items-center">
                <div class="author-img">
                    @if ($blog->user->google_id)
                        <img src="{{ $blog->user->foto }}" alt="author" class="rounded-circle" width="50px" height="50px">
                    @else
                        <img src="{{ Storage::url($blog->user->foto) }}" alt="author" class="rounded-circle" width="50px" height="50px">
                    @endif
                </div>
                <div class="author-name ml-3">
                    <p class="m-0"><a href="{{ route("user.show", $blog->user->slug) }}">{{ $blog->user->name }}</a> in <a href="{{ route("blogs.categoryView", $blog->category->slug) }}">{{ $blog->category->name }}</a></p>
                    <p class="m-0">Sep 9, 2020 • 2 min read</p>
                </div>
            </div>
            <center class="icon-scroll">
                <a href="#detail-post" class="page-scroll">
                    <img src="{{ asset("blog/img/icons/icon_scroll.png") }}" alt="icon_scroll">
                </a>
            </center>
        </div>
    </div>

    <section id="detail-post" class="detail-post my-5">
        <div class="container">
            <div class="row justify-content-lg-center">
                <div class="col-md-8">
                    <div class="detail-post-thumbnail">
                        <div class="post-image">
                            <img src="{{ Storage::url($blog->thumbnail) }}" alt="html" class="img-fluid w-100" style="max-height: 500px">
                        </div>
                        <div class="breadcrumb-detail-post mt-3">
                            <p><a href="{{ route("user.artikelku") }}" class="font-normal">Artikel Ku</a> &raquo; <b>{{ $blog->title }}</b></p>
                        </div>
                    </div>
                    <div class="detail-post-content mt-4">
                        {!! $blog->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $('.page-scroll').on('click', function (e) {
            var tujuan = $(this).attr('href');
            var elemenTujuan = $(tujuan);
            $('html , body').animate({
                scrollTop: elemenTujuan.offset().top - 100
            },100);
            e.preventDefault();
        });
    </script>
@endsection