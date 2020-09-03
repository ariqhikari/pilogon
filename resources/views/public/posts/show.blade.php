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
        background-color: #fff;
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

    .komentar-child{
        margin-left: 65px;
    }

    @media (min-width: 768px) { 
        .komentar-child{
            margin-left: 81px;
        }
    }

    @media (min-width: 992px) { 
        .komentar-child{
            margin-left: 112px;
        }
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
                <div class="col-md-2 col-lg-1 text-center">
                    <div class="share-comment sticky-top py-md-5">
                        <div class="share-post">
                            <p>Share</p>
                            <a href="https://twitter.com/intent/tweet?text={{ $blog->title }} {{ url()->current() }}" target="_blank" rel="noopener" class="d-md-block mx-4 mx-md-0 my-4">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?" target="_blank" rel="noopener" class="d-md-block mx-4 mx-md-0 my-4">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ $blog->title }} {{ url()->current() }}" target="_blank" rel="noopener" class="d-md-block mx-4 mx-md-0 my-4">
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
                        <div class="post-image">
                            <img src="{{ Storage::url($blog->thumbnail) }}" alt="html" class="img-fluid w-100" style="max-height: 500px">
                        </div>
                        <div class="breadcrumb-detail-post mt-3">
                            <p><a href="{{ route("blogs.index") }}" class="font-normal">Blogs</a> &raquo; <b>{{ $blog->title }}</b></p>
                        </div>
                    </div>
                    <div class="detail-post-content mt-4">
                        {!! $blog->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Komentar & Related Post -->
    <section class="related-post mt-5" id="related-post">
        <div class="container post pt-4">
            <div class="post-item my-5">
                <div class="row mt-4">
                    @foreach ($recent as $item)
                    <div class="col-md-6 col-lg-4 my-3">
                        <div class="card box-profile">
                            <a href="{{ route("blogs.show",$item) }}" class="text-decoration-none">
                                <center>
                                    <img src="{{ Storage::url($item->thumbnail) }}" alt="html" style='width:90%;margin-top:18px;border-radius:10px' height="200px">
                                </center>
                            </a>
                            <div class="card-body">
                                <a href="{{ route("blogs.show",$item) }}" class="text-decoration-none">
                                    <h5 class="card-title">
                                        {{ substr($item->title,0,20) }}....
                                    </h5>
                                </a>
                                <div class="author d-flex mt-4 align-items-center">
                                    <div class="author-img">
                                        @if ($item->user->google_id)
                                            <img src="{{ $item->user->foto }}" alt="author" class="rounded-circle" width="50px" height="50px">
                                        @else
                                            <img src="{{ Storage::url($item->user->foto) }}" alt="author" class="rounded-circle" width="50px" height="50px">
                                        @endif
                                    </div>
                                    <div class="author-name ml-3">
                                        <p class="m-0"><a href="{{ route("user.show", $item->user->slug ) }}">{{ $item->user->name }}</a> in <a href="{{ route("blogs.categoryView",$item->category) }}">{{ $item->category->name }}</a></p>
                                        <p class="m-0">{{ $item->created_at->diffForHumans() }} • {{ $item->views->count() }} read</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="komentar" id="komentar">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <h2>Komentar</h2>
                    </div>
                </div>
                @foreach ($blog->comments as $item)
                    @if ($item->parent == 0)
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card komentar-item my-4" id="{{ $item->id . '-' . $item->user->id }}">
                                <div class="card-body">
                                    <div class="author d-flex justify-content-between mt-2">
                                        <div class="komentar-left  d-flex align-items-center">
                                            <div class="author-img">
                                                @if ($item->user->google_id)
                                                    <img src="{{ $item->user->foto }}" alt="komentar" class="rounded-circle" width="50px" height="50px">
                                                @else
                                                    <img src="{{ Storage::url($item->user->foto) }}" alt="komentar" class="rounded-circle" width="50px" height="50px">
                                                @endif
                                            </div>
                                            <div class="author-name ml-3">
                                                <p class="m-0"  style="color: #333333">{{ $item->user->name }}</p>
                                                <small class="m-0">User</small>
                                            </div>
                                        </div>
                                        <div class="komentar-right">
                                            <p>{{ $item->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="komentar-desc my-3" style="margin-left: 65px">
                                        <p>{{ $item->comment }}</p>
                                    </div>
                                    @foreach ($item->childs as $item2)
                                        <div class="author d-flex justify-content-between ml-md-3 ml-lg-5 mt-3">
                                            <div class="komentar-left  d-flex align-items-center">
                                                <div class="author-img">
                                                    @if ($item2->user->google_id)
                                                        <img src="{{ $item2->user->foto }}" alt="komentar" class="rounded-circle" width="50px" height="50px">
                                                    @else
                                                        <img src="{{ Storage::url($item2->user->foto) }}" alt="komentar" class="rounded-circle" width="50px" height="50px">
                                                    @endif
                                                </div>
                                                <div class="author-name ml-3">
                                                    <p class="m-0" style="color: #333333">{{ $item2->user->name }}</p>
                                                    <small class="m-0">User</small>
                                                </div>
                                            </div>
                                            <div class="komentar-right">
                                                <p>{{ $item2->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <div class="komentar-desc my-2 mb-3 komentar-child">
                                            <p><a href="#{{ $item->id . '-' . $item->user->id }}" class="d-block">Replying {{ $item->user->name }}</a> {{ $item2->comment }}</p>
                                        </div>
                                    @endforeach
                                    <hr>
                                    <a class="float-right" href="{{ route("blogs.balas",[$blog, $item->id]) }}" role="button"
                                        aria-expanded="false" aria-controls="collapse1">
                                        Balas
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
                <div class="row justify-content-center" style="margin-top: -30px">
                    <div class="col-md-8">
                        <div class="komentar-form my-5">
                            @if (!isset($parent))
                                <form action="{{ route("post-comment.store") }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <textarea class="form-control @error("comment") is-invalid @enderror" placeholder="Komentar" name="comment" rows="5"></textarea>
                                        <input type="hidden" value="{{ $blog->id }}" name="blog_id">
                                        @error('comment')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn text-white btn-block mb-5" style="background: #262C39">Kirim Komentar</button>
                                </form>
                            @else
                                <form action="{{ route("post-comment.storeBalasan") }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <textarea autofocus class="form-control @error("comment") is-invalid @enderror" placeholder="Balas komentar {{ $parent->user->name }}" name="comment" rows="5"></textarea>
                                        <input type="hidden" value="{{ $blog->id }}" name="blog_id">
                                        <input type="hidden" name="parent_id" value="{{ $parent->id }}">
                                        @error('comment')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn text-white btn-block mb-5" style="background: #262C39">Balas Komentar</button>
                                </form>
                            @endif
                        </div>
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
            }, 100);
            e.preventDefault();
        });
    </script>
@endsection