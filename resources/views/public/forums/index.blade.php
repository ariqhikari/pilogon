@extends('landing_page.master')

@section("title","Forum - Pilogon")

@section('logo')
    <img src="{{ asset("resource/image/logo tulisan.png") }}" alt="" width="130px" style="margin-top: -10px;margin-left:30px"
    >
@endsection

@section('css')
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
        <div class="row">
            <div class="col-md-7 mt-4 text-center text-md-left" data-aos="fade-up">
                <h1 id="title-class">Forum Bertanya</h1>
                <p id="sub-title-class">Forum ini bisa kita gunakan sebagai media berdiskusi ketika diantara kita mendapatkan kesulitan dalam membuat programnya tersendiri, maka di forum ini kita sebagai sesama programmer harus membantunya.</p>
                <a href="{{ route("forum.create") }}" id="btn-class" class="btn btn-class">Bertanya</a>
            </div>
            <div class="col-md-5 text-center" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset("resource/image/forum_head.png") }}" width="70%" alt="">
            </div>
        </div>
        <div class="row mt-5 justify-content-center">
            <div class="col-md-12 mt-4">
                <div class="row">
                    <div class="col">
                        <div class="card box-profile" data-aos="fade-up" data-aos-delay="300">
                            <div class="card-body">
                                <form action="{{ route("forum.search") }}" method="post">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" name="keyword" class="form-control @error("keyword") is-invalid @enderror" placeholder="Masukkan kata kunci" style="background-color: transparent;border-right:none">
                                        <div class="input-group-append">
                                            <button class="btn" style="border: solid 1px #CED4DA;border-left:none" type="submit"><i class="fas fa-search"></i></button>
                                        </div>
                                        @error('keyword')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" id="kelas">
                <div class="row">
                    @if ($forums->count() <= 0)
                        <div class="col-md-12 text-center" data-aos="fade-up" data-aos-delay="400">
                            <img src="{{ asset("resource/image/null.png") }}" width="250px" alt="">
                        </div>
                    @else
                        @foreach ($forums as $item)
                            <div class="col-md-6 col-lg-4 mt-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration + 4 }}00">
                                <a href="{{ route("forum.show",$item->slug) }}" style="text-decoration: none">
                                    <div class="card box-profile">
                                        <div class="card-body">
                                            <h4 class="card-title mt-2" style="text-transform: capitalize;color:rgb(56, 56, 56)">{{ substr($item->title,0,20) }}..</h4>
                                            <div>
                                                @if ($item->user->google_id)
                                                    <img src="{{ $item->user->foto }}" alt="" width="40px" class="rounded-circle float-left" height="40px" style="margin-right:10px">
                                                @else
                                                    <img src="{{ Storage::url($item->user->foto) }}" alt="" width="40px" class="rounded-circle float-left" height="40px" style="margin-right:10px">
                                                @endif
                                                <h6 style="color: rgb(129, 129, 129)">{{ $item->user->name }}</h6>
                                                <h6 style="color: rgb(129, 129, 129);margin-top:-5px">{{ $item->created_at->diffForHumans() }}</h6>
                                            </div>
                                            <div>
                                                <div style="float: left">
                                                    @foreach ($item->categorys as $item2)
                                                        <span class="badge badge-dark mt-3">{{ $item2->name }}</span>
                                                    @endforeach
                                                </div>
                                                <div style="float: right">
                                                    @if (in_array($item->id,$likes_me))
                                                        <i class="fas fa-heart" style="color:#262C39"> {{ $item->likes->count() }}</i>
                                                    @else
                                                        <i class="far fa-heart" style="color:#262C39"> {{ $item->likes->count() }}</i>
                                                    @endif
                                                        <i class="far fa-comment mt-3 ml-2" style="color: #262C39"> {{ $item->comments->count() }}</i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
@endsection
