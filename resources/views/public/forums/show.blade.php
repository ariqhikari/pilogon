@extends('landing_page.master')

@section("title","$forum->title")

@section('logo')
    <img src="{{ asset("resource/image/logo tulisan.png") }}" alt="" width="130px" style="margin-top: -10px;margin-left:30px"
    >
@endsection

@section('css')
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

        .box-comment-2{
            margin-left:100px;
        }

        @media (max-width: 576px) {    
        .box-comment-2{
            margin-left:0;
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
                        <img src="{{ Storage::url($forum->user->foto) }}" alt="" width="60px" height="60px" class="rounded-circle">
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
                                    <h3 class="card-title float-left">{{ $forum->title }}</h3>
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
                            <div class="card-body">
                                <h5 class="pb-2">{{ $forum->comments->count() }} Jawaban</h5>
                                @foreach ($forum->comments as $item)
                                    @if ($item->parent == 0)
                                        <div class="card px-3 py-4 shadow-sm border-0">
                                            <h6 style="color: rgb(90, 90, 90);">
                                                {!! $item->comment !!}
                                            </h6>
                                            <div class="sub-box-forum-1">
                                                <div style="float: left">
                                                    <img src="{{ Storage::url($item->user->foto) }}" width="50px" height="50px" class="rounded-circle float" alt="">
                                                </div>
                                                <div style="float:right">
                                                    <h6 style="text-transform: capitalize;margin-top:5px">Dijawab oleh {{ $item->user->email }}</h6>
                                                    <div>
                                                        <h6 style="color: rgb(112, 112, 112);margin-top:-5px;float:left">Ditulis {{ $item->created_at->diffForHumans() }}</h6>
                                                        <a href="{{ route("jawaban-forum.balas",[$item->id,$forum]) }}">
                                                            <h6 style="float: right;margin-top:-5px;">Balas</h6>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @foreach ($item->childs as $item2)
                                        <div class="card px-3 py-4 my-3 shadow-sm border-0 box-comment-2">
                                            <div class="">
                                                <h6 style="color: rgb(90, 90, 90);">
                                                    {!! $item2->comment !!}
                                                </h6>
                                                <div class="sub-box-forum-2">
                                                    <div style="float: left">
                                                        <img src="{{ Storage::url($item2->user->foto) }}" width="50px" height="50px" class="rounded-circle float" alt="">
                                                    </div>
                                                    <div style="float:right">
                                                        <h6 style="text-transform: capitalize;margin-top:5px">Dijawab oleh {{ $item2->user->email }}</h6>
                                                        <div>
                                                            <h6 style="color: rgb(112, 112, 112);margin-top:-5px;float:left">Ditulis {{ $item2->created_at->diffForHumans() }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <hr style="clear: both;margin-top:100px">
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
                                                @if ($parent->user_id != Auth::id())
                                                    Balas {{ $parent->user->email }}
                                                @endif
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
                            <a href="{{ route("forum.show",$item) }}">
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
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });

            CKEDITOR.replace( 'desc',{
                filebrowserUploadUrl: "{{route('class.image', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });

            new ClipboardJS('.btn');
    </script>
@endsection
