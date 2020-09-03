@extends('landing_page.master')

@push('addon-meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section("title","$forum->title - Pilogon")

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

    .box-comment-2{
        margin-left:100px;
    }

    .komentar .komentar-item {
        box-shadow: none;
    }

    @media (max-width: 576px) {    
        .box-comment-2{
            margin-left:0;
        }
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
    <div class="container" style="clear: both">
        <div class="row">
            <div class="col-lg-8">
                <div class="row align-items-center">
                    <div class="col-md-2 col-lg-1 text-center">
                        @if ($forum->user->google_id)
                            <img src="{{ $forum->user->foto }}" alt="" width="60px" height="60px" class="rounded-circle">
                        @else
                            <img src="{{ Storage::url($forum->user->foto) }}" alt="" width="60px" height="60px" class="rounded-circle">
                        @endif
                    </div>
                    <div class="col-md-5 text-left">
                        <h4 id="profile-penanya-1">{{ $forum->user->name }}</h4>
                        <h6 id="profile-penanya-2"> {{ $forum->created_at->diffForHumans() }}</h6>
                    </div>
                    <div class="col-md-5 col-lg-6 text-center d-flex justify-content-between">
                        <div class="mx-3 mx-lg-0">
                            <h5>{{ $forum->likes->count() }}</h5>
                            <h6 style="color: rgb(119, 119, 119)">Like</h6>
                        </div>
                        <div class="mx-3 mx-lg-0">
                            <h5>{{ $forum->comments->count() }}</h5>
                            <h6 style="color: rgb(119, 119, 119)">Jawaban</h6>
                        </div>
                        <div class="mx-3 mx-lg-0">
                            <h5>{{ $forum->categorys->count() }}</h5>
                            <h6 style="color: rgb(119, 119, 119)">Tag</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card box-profile">
                            <div class="card-body">
                                <div>
                                    <div class="row">
                                        <div class="col-md-8 col-lg-9">
                                            <h3 class="card-title float-left">{{ $forum->title }}</h3>
                                        </div>
                                        <div class="col-md-4 col-lg-3">
                                            @if (in_array($forum->id,$likes_me))
                                                <a href="{{ route("likes.unlike",$forum->id) }}">
                                                    <i class="fas fa-heart" style="float: right;font-size:20px;color:#262C39;margin-top:5px" data-toggle="tooltip" data-placement="top" title="Unlike"></i>
                                                </a>
                                            @else
                                                <a href="{{ route("likes.like",$forum->id) }}">
                                                    <i class="far fa-heart" data-toggle="tooltip" data-placement="top" title="Like"  style="float: right;font-size:20px;color:#262C39;margin-top:5px"></i>
                                                </a>
                                            @endif
                                            <!-- Target -->
                                            <input id="foo" value="{{ $link }}" style="opacity:0;position:absolute;width:10px" readonly>

                                            <!-- Trigger -->
                                            <button class="btn d-none d-md-block float-right" data-clipboard-target="#foo" data-toggle="tooltip" data-placement="top" title="Copy link" style="margin-top:-2px;margin-right:10px">
                                                <i class="fas fa-link" style="font-size:20px;color:#262C39"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div style="clear: both">
                                    @foreach ($forum->categorys as $item)
                                    <a href="" class="btn box-tag mt-md-1 mt-lg-0">
                                        {{ $item->name }}
                                    </a>
                                    @endforeach
                                    <h6 style="margin-top: 20px;color:rgb(82, 82, 82);" class="w-100 overflow-auto">
                                        {!! $forum->problem !!}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card box-profile">
                            <div class="card-body komentar">
                                <h5 class="pb-2">{{ $forum->comments->count() }} Jawaban</h5>
                                @foreach ($forum->comments as $item)
                                    @if ($item->parent == 0)
                                    <div class="row">
                                        <div class="col-md-12 px-4">
                                            <div class=" komentar-item my-4" id="{{ $item->id . '-' . $item->user->id }}">
                                                <div class="">
                                                    <div class="author d-flex justify-content-between mt-2">
                                                        <div class="komentar-left  d-flex align-items-center">
                                                            <div class="author-img">
                                                                @if ($item->ser->google_id)
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
                                                        <div class="komentar-right" style="color: #818181;">
                                                            <p>{{ $item->created_at->diffForHumans() }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="komentar-desc my-3" style="margin-left: 65px;color: #818181;">
                                                        <p>{!! $item->comment !!}</p>
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
                                                            <div class="komentar-right" style="color: #818181;">
                                                                <p>{{ $item2->created_at->diffForHumans() }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="komentar-desc my-2 mb-3 komentar-child" style="color: #818181">
                                                            <p><a href="#{{ $item->id . '-' . $item->user->id }}" class="d-block" style="color:#474747">Replying {{ $item->user->name }}</a> {!! $item2->comment !!}</p>
                                                        </div>
                                                    @endforeach
                                                    <hr>
                                                    <a class="float-right" href="{{ route("forum.balas",[$forum, $item->id]) }}" role="button"
                                                        aria-expanded="false" aria-controls="collapse1">
                                                        Balas
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card box-profile">
                            <div class="card-body">
                                @if (!isset($parent))
                                    <form action="{{ route("jawaban-forum.store") }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <textarea name="jawaban" class="form-control @error('jawaban') is-invalid @enderror" id="desc" cols="30" rows="6"></textarea>
                                            @error('jawaban')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <input type="hidden" name="forum_id" value="{{ $forum->id }}">
                                        </div>
                                        <button type="submit" class="btn btn-dark btn-block" style="background-color: #262C39">Submit Jawaban</button>
                                    </form>
                                @else
                                    <form action="{{ route("jawaban-forum.storeBalasan") }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <textarea autofocus name="jawaban" class="form-control @error('jawaban') is-invalid @enderror" id="desc" cols="30" rows="6">
                                                Balas {{ $parent->user->name }}
                                            </textarea>
                                            @error('jawaban')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <input type="hidden" name="forum_id" value="{{ $forum->id }}">
                                            <input type="hidden" name="parent_id" value="{{ $parent->id }}">
                                        </div>
                                        <button type="submit" class="btn btn-dark btn-block" style="background-color: #262C39">Submit Balasan</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-4">
                <div class="card box-profile">
                    <div class="card-body">
                        <h4 class="card-title">Pertanyaan Terbaru</h4>
                        @foreach ($recent as $item)
                            <hr>
                            <a href="{{ route("forum.show",$item) }}" style="color:#474747">
                                <h5>{{ $item->title }}</h5>
                            </a>
                            <h6 style="color: rgb(119, 119, 119)">{{ $item->created_at->diffForHumans() }}</h6>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('includes.summernote')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

        new ClipboardJS('.btn');
    </script>
@endsection
