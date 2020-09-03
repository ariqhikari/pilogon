@extends('landing_page.master')

@section("title","$covercourse->title - Pilogon")

@section('logo')
    <img src="{{ asset("resource/image/logo_putih.png") }}" alt="" width="130px" style="margin-top: -10px;margin-left:30px"
    >
@endsection

@section('css')
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
            background-color: #181E2B;
        }

        .sidenav a{
            color: #f7f7f7;
        }

        .scroll{
            overflow: scroll;
            height: 375px;
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div style="width: 100%;height:550px;background-color:#181E2B;margin-top:-110px;padding-top:120px" id="box-cls-head">
        <div class="container" style="clear: both">
            <div class="row text-center text-white justify-content-center">
                <div class="col-md-6">
                    <br>
                    <h1>{{ $covercourse->title }}</h1>
                    <p style="color: #b6b4b4d8;font-weight:300">Dibuat Oleh {{ $covercourse->user->name }}</p>
                </div>
            </div>
            <div class="row text-center">
                <div class="col">
                    <hr style="border:solid 1px white;width:50px">
                </div>
            </div>
            <br>
            <div class="row text-center justify-content-center">
                <div class="col-md-8 d-flex justify-content-between flex-row" style="margin-right: 35px">
                    <div class="mx-2">
                        <h5 style="color: #cfcfcf">Pendaftar</h5>
                        <h3 style="color: #59E0C0 ">{{ $covercourse->userRegistered->count() }}</h3>
                    </div>
                    <div class="mx-2">
                        <h5 style="color: #cfcfcf">Level</h5>
                        <h3 style="color: #59E0C0;text-transform:capitalize">{{ $covercourse->level }}</h3>
                    </div>
                    <div class="mx-2">
                        <h5 style="color: #cfcfcf" >Modul</h5>
                        <h3 style="color: #59E0C0 ">{{ $covercourse->modules->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="clear: both;">
        <div class="row justify-content-center" id="box-class-side">
            <div class="col-md-6 col-lg-7">
                <div class="card" style="border-radius: 8px;background-color:#ffffff">
                    <div class="card-body">
                        <div style="width: 100%;">
                            <img src="{{ Storage::url($covercourse->thumbnail) }}" style="border-radius:8px;max-height:500px" alt="" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3" id="box-class-side-1">
                <div class="card scroll" style="border-radius: 8px;background-color:#ffffff">
                    <div class="card-body">
                        <h5 style="margin-bottom: 10px">Modul Kelas</h5>
                        @if (!in_array($covercourse->id,$data_course))
                            @foreach ($covercourse->modules as $item)
                                <div style="width:100%;background-color:rgb(241, 241, 241);margin-top:5px;border-radius:5px">
                                    <h6 style="margin-left:20px;line-height:30px">{{ $item->title }}</h6>
                                </div>
                            @endforeach
                        @else
                            @foreach ($covercourse->modules as $item)
                                <div style="width:100%;background-color:rgb(241, 241, 241);margin-top:5px;border-radius:5px">
                                    <a href="{{ route("class.belajar",[$covercourse->slug,$item->id]) }}">
                                        <h6 style="margin-left:20px;line-height:30px">{{ $item->title }}</h6>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 justify-content-center">
            <div class="col-md-6 col-lg-7">
                <h3>Deskripsi Kelas</h3>
                <p>
                    {!! $covercourse->description !!}
                </p>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="container">
                    <div class="row text-center justify-content-center">
                        <div class="card" style="box-shadow:0px 0px 2px 1px rgb(223, 223, 223);background-color:#f2f2f2">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <a href="{{ route("user.show", $covercourse->user) }}" style="color:#333">
                                        <img src="{{ Storage::url($covercourse->user->foto) }}" alt="" width="80px" height="80px" class="rounded-circle mb-2">
                                        <h5>{{ $covercourse->user->name }}</h5>
                                    </a>
                                        @if ($covercourse->user->profiles[0]->asal_sekolah != null)
                                        <h6 style="color: grey;margin-top:-7px">{{  $covercourse->user->profiles[0]->asal_sekolah }}</h6>
                                    @endif
                                    <a 
                                        @if ($covercourse->user->profiles[0]->instagram != null)
                                            href="{{ $covercourse->user->profiles[0]->instagram }}"
                                        @else
                                            href="#"
                                        @endif
                                    style="text-decoration: none;color:#262C39;font-size:25px;margin-right:10px">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <a 
                                        @if ($covercourse->user->profiles[0]->github != null)
                                        href="{{ $covercourse->user->profiles[0]->github }}"
                                        @else
                                            href="#"
                                        @endif
                                    style="text-decoration: none;color:#262C39;font-size:25px;margin-right:10px">
                                        <i class="fab fa-github"></i>
                                    </a>
                                    <a 
                                        @if ($covercourse->user->profiles[0]->facebook != null)
                                        href="{{ $covercourse->user->profiles[0]->facebook }}"
                                        @else
                                            href="#"
                                        @endif
                                    style="text-decoration: none;color:#262C39;font-size:25px">
                                        <i class="fab fa-facebook-square"></i>
                                    </a>
                                    @if ($covercourse->user->profiles[0]->biodata != null)
                                        <h6 style="color: grey;margin-top:5px">{{ substr($covercourse->user->profiles[0]->biodata,0,80) }}...</h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center mt-4 justify-content-center">
                        <div class="card" style="width: 100%;box-shadow:0px 0px 2px 1px rgb(223, 223, 223);background-color:#f2f2f2">
                            <div class="card-body">
                                <div class="col-md">
                                    @auth
                                        @if (Auth::user()->course_registered->count() > 0)
                                            @if (in_array($covercourse->id,$data_course))
                                                @foreach (Auth::user()->course_registered as $item)
                                                    @if ($item->id == $covercourse->id)
                                                        <div class="alert alert-info" role="alert">
                                                            Kamu Sudah terdaftar dikelas ini
                                                        </div>
                                                        @if ($item->pivot->index != null)
                                                            @foreach (Auth::user()->course_registered as $item)
                                                                    @if ($item->id == $covercourse->id)
                                                                        <a href="{{ route("class.belajar",[$covercourse,$covercourse->modules[$item->pivot->index]->id]) }}">
                                                                            <button class="btn btn-dark btn-block" style="background: #181E2B" type="button">Lanjut Belajar</button>
                                                                        </a>
                                                                    @endif
                                                            @endforeach
                                                    @else
                                                        <a href="{{ route("class.belajar",[$covercourse,$covercourse->modules[0]->id]) }}">
                                                            <button class="btn btn-dark btn-block" style="background: #181E2B" type="button">Mulai Belajar</button>
                                                        </a>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if (!in_array($covercourse->id,$data_course))
                                                <div class="alert alert-info" role="alert">
                                                    Kamu belum terdaftar dikelas ini
                                                </div>
                                                <a href="{{ route("class.daftar",$covercourse->slug) }}">
                                                    <button class="btn btn-dark btn-block" style="background: #181E2B" type="button">Daftar Kelas</button>
                                                </a>
                                            @endif
                                        @else
                                            <div class="alert alert-info" role="alert">
                                                Kamu belum terdaftar dikelas ini
                                            </div>
                                            <a href="{{ route("class.daftar",$covercourse->slug) }}">
                                                <button class="btn btn-dark btn-block" style="background: #181E2B" type="button">Daftar Kelas</button>
                                            </a>
                                        @endif
                                    @endauth
                                    @guest
                                        <div class="alert alert-info" role="alert">
                                            Harap login terlebih dahulu untuk mendaftar di kelas ini
                                        </div>
                                        <a href="{{ route("login") }}">
                                            <button class="btn btn-dark btn-block" style="background: #181E2B" type="button">Login</button>
                                        </a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection