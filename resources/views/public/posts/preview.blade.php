@extends('landing_page.master')

@section("title","$blog->title")

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
    <div class="jumbotron">
        <div class="container mt-5" style="clear:both;padding-top:80px"">
            <h1 class="display-4">{{ $blog->title }}</h1>
            <div class="author mt-4 d-flex align-items-center">
                <div class="author-img">
                    <img src="{{ Storage::url($blog->user->foto) }}" alt="author" class="rounded-circle" width="50px" height="50px">
                </div>
                <div class="author-name ml-3">
                    <p class="m-0"><a href="">{{ $blog->user->name }}</a> in <a href="">{{ $blog->category->name }}</a></p>
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
            <div class="row justify-content-center">
                <div class="col-md-1 text-center">
                    <div class="share-comment sticky-top py-md-5">
                        <div class="share-post">
                            <p>Share</p>
                            <a href="https://twitter.com/intent/tweet?" class="d-md-block mx-4 mx-md-0 my-4">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?" class="d-md-block mx-4 mx-md-0 my-4">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text=" class="d-md-block mx-4 mx-md-0 my-4">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                        <hr>
                        <div class="reply-post d-none d-md-block">
                            <p>Reply</p>
                            <a href="#komentar" class="page-scroll">{{ $blog->comments->count() }}</a>
                            <a href="#komentar" class="d-block my-3 page-scroll">
                                <i class="far fa-comment"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="detail-post-thumbnail">
                        <img src="{{ Storage::url($blog->thumbnail) }}" alt="html" class="img-fluid">
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