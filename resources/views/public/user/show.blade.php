@extends('landing_page.master')


@section("title","$user->name Profile - Pilogon")

@section('logo')
    <img src="{{ asset("resource/image/logo_putih.png") }}" alt="" width="130px" style="margin-top: -10px;margin-left:30px">
@endsection

@section('css')
    <style>
        body{
            background-color: #f2f2f2
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
            color:white
        }

        ::-webkit-scrollbar-thumb {
            background-color: #262C39;
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
    <div style="background-repeat:no-repeat;background-size:cover;background-position:center;background-attachment:fixed;width: 100%;height:350px;background-image:url('{{ asset("resource/image/hd3.jpg") }}');margin-top:-120px">
    </div>

    <div class="container mt-4" style="clear: both">
        <div class="row justify-content-center" style="margin-top: -100px">
            <div class="col-md-9">
                <div class="card box-profile">
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col">
                                @if ($user->google_id)
                                    <img src="{{ $user->foto }}" width="150px" height="150px" style="border-radius:50%;margin-top:-100px" alt="{{ $user->name }}">
                                @else
                                    <img src="{{ Storage::url($user->foto) }}" width="150px" height="150px" style="border-radius:50%;margin-top:-100px" alt="{{ $user->name }}">
                                @endif
                                <br><br>
                                <h2 style="text-transform: capitalize;font-weight:300">{{ $user->name }}</h2>
                                <p>Bergabung Pada {{ $user->created_at->format("d M Y") }}</p>
                                @if ($user->profiles[0]->asal_sekolah != null)
                                    <p style="margin-top: -18px"><i class="fas fa-school"></i> {{$user->profiles[0]->asal_sekolah }}</p>
                                @else
                                    <p>Profile Belum Diupdate</p>
                                @endif
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-md">
                                @if ($user->profiles[0]->biodata != null)
                                    <p style="color:grey">{{ $user->profiles[0]->biodata }}</p>
                                @else
                                    <p>Profile Belum Di Update</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center text-center mt-5">
            <div class="col-md-3">
                <div class="card box-profile" id="bp-1">
                    <div class="card-body">
                        <h5 class="card-title mt-2">Artikel</h5>
                        <hr style="width: 45px;border:solid 1px #262C39;border-radius:5px;margin-top:-1px">
                        <img src="{{ asset("resource/image/article.png") }}" width="100%" alt="">
                        <h4>{{ $user->posts->count() }}</h4>
                        @auth
                            @if (Auth::user()->id == $user->id)
                                <a href="{{ route("user.artikelku") }}">
                                    <button class="btn-profile mb-2">Lihat Semua</button>
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card box-profile" id="bp-2">
                    <div class="card-body">
                        <h5 class="card-title mt-2">Kelas</h5>
                        <hr style="width: 45px;border:solid 1px #262C39;border-radius:5px;margin-top:-1px">
                        <img src="{{ asset("resource/image/course.png") }}" width="100%" height="143px" alt="">
                        <h4>{{ $user->course_registered->count()+$user->courses->count() }}</h4>
                        @auth
                            @if (Auth::user()->id == $user->id)
                                <a href="{{ route("user.pilihan") }}">
                                    <button class="btn-profile mb-2">Lihat Semua</button>
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card box-profile" id="bp-3">
                    <div class="card-body">
                        <h5 class="card-title mt-2">Pertanyaan Forum</h5>
                        <hr style="width: 45px;border:solid 1px #262C39;border-radius:5px;margin-top:-1px">
                        <img src="{{ asset("resource/image/forum-user.png") }}" width="67%" alt="">
                        <h4>{{ $user->forums->count() }}</h4>
                        @auth
                            @if (Auth::user()->id == $user->id)
                                <a href="{{ route("forum.user") }}">
                                    <button class="btn-profile mb-2">Lihat Semua</button>
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-9">
                <div class="card box-profile">
                    <div class="card-body">
                        <div class="row justify-content-center text-center">
                            <div class="col-md-3">
                                @if ($user->profiles[0]->instagram != null)
                                    <a href="{{ $user->profiles[0]->instagram }}">
                                        <i class="fab fa-instagram" style="font-size: 30px;color:#262C39"></i>
                                    </a>
                                @else
                                    <a href="">
                                        <i class="fab fa-instagram" style="font-size: 30px;color:#262C39"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="col-md-3">
                                @if ($user->profiles[0]->facebook != null)
                                    <a href="{{ $user->profiles[0]->facebook }}">
                                        <i class="fab fa-facebook-square" style="font-size:30px;color:#262C39"></i>
                                    </a>
                                @else
                                    <a href="">
                                        <i class="fab fa-facebook-square" style="font-size:30px;color:#262C39"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="col-md-3">
                                @if ($user->profiles[0]->github != null)
                                    <a href="{{ $user->profiles[0]->github }}">
                                        <i class="fab fa-github" style="font-size: 30px;color:#262C39"></i>
                                    </a>
                                @else
                                    <a href="">
                                        <i class="fab fa-github" style="font-size: 30px;color:#262C39"></i>
                                    </a>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection