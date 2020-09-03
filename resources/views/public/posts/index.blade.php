@extends('landing_page.master')

@section("title","Blogs - Pilogon")

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
            border: none;
            background-color: #f2f2f2;
            color: #262C39;
        }

        .btn-registrasi:hover{
            background-color: #dfdede;
        }

        .btn-login{
            background-color: transparent;
            color: #f2f2f2;
            border: 2px solid #f2f2f2;
        }

        .btn-login:hover {
            background-color: #58dfbf;
            border-color: #58dfbf;
            color: #ffffff;
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
        <div class="container text-center pb-3" style="clear:both;padding-top:80px" data-aos="fade-up">
            <h1 class="display-4" id="title-blog-head">Blogs Pilogon</h1>
            <p class="lead" id="sub-title-blog-head">Blog-blog terkait tutorial atau tips & trick pemrograman.</p>
            <a href="{{ route("blogs.create") }}" class="btn btn-blog mt-2">
                Tulis Blog
            </a>
            <center class="icon-scroll">
                <a href="#post" class="page-scroll">
                    <img src="{{ asset("blog/img/icons/icon_scroll.png") }}" alt="icon_scroll">
                </a>
            </center>
        </div>
    </div>
    
    <!-- Post -->
    <section id="post" class="post">
        <div class="container">
            <div class="post-item my-5">
                <div class="row">
                    <div class="col d-md-flex justify-content-between align-items-center heading-post">
                        <h2>Featured Post</h2>
                        <a href="{{ route("blogs.view") }}" class="d-inline-block d-md-block">
                            View More &raquo;
                        </a>
                    </div>
                </div>
                <hr>
                <div class="row mt-4">
                    @forelse ($posts as $item)
                    <div class="col-md-6 col-lg-4 my-3" data-aos="fade-up" data-aos-delay="{{ 3 + $loop->iteration }}00">
                        <div class="card box-profile">
                            <a href="{{ route("blogs.show",$item) }}" class="text-decoration-none">
                                <center>
                                    <img src="{{ Storage::url($item->thumbnail) }}" alt="html" height="200px" style="width:90%;border-radius:10px;margin-top:17px">
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
                                        <img src="{{ Storage::url($item->user->foto) }}" alt="author" width="50px" height="50px" class="rounded-circle">
                                    </div>
                                    <div class="author-name ml-3">
                                        <p class="m-0"><a href="{{ route("user.show", $item->user->slug ) }}">{{ $item->user->name }}</a> in <a
                                                href="{{ route("blogs.categoryView",$item->category) }}">{{ $item->category->name }}</a></p>
                                        <p class="m-0">{{ $item->created_at->diffForHumans() }} • {{ $item->views->count() }} read</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="col-md-12 text-center" data-aos="fade-up" data-aos-delay="300">
                            <img src="{{ asset("resource/image/null.png") }}" width="250px" alt="">
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="post-item my-5">
                <div class="row">
                    <div class="col d-md-flex justify-content-between align-items-center heading-post">
                        <h2>Categorys Post</h2>
                    </div>
                </div>
                <hr>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="row">
                            @foreach ($categorys as $item)
                            <div class="col-md-6 col-lg-4 my-3" data-aos="fade-up" data-aos-delay="{{$loop->iteration}}00">
                                <div class="card box-profile" style="height:220px;background-repeat:no-repeat;background-size:cover;background-position:center;background-image: url('{{ Storage::url($item->gambar) }}')">
                                    <a href="{{ route("blogs.categoryView",$item) }}" class="text-decoration-none">
                                        <div style="width: 90%;height:188px;background-color:#181E2B;border-radius:10px;margin:auto;margin-top:16px;opacity:.8">
                                            <br><br><br>
                                            <center>
                                                <div>
                                                    <h1 style="color: #ffffff;opacity:1;font-size:40px">{{ $item->name }}</h1>
                                                </div>
                                            </center>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-2">
                                {{ $categorys->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
    <script>
        $('.page-scroll').on('click', function (e) {
            var tujuan = $(this).attr('href');
            var elemenTujuan = $(tujuan);
            $('html , body').animate({
                scrollTop: elemenTujuan.offset().top - 100
            }, 100);
            e.preventDefault();
        });
    </script>
@endsection