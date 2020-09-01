@extends('landing_page.master')


@section("title","Pilihan Kelas - Pilogon")

@section('logo')
    <img src="{{ asset("resource/image/logo tulisan.png") }}" alt="" width="130px" style="margin-top: -10px;margin-left:30px">
@endsection

@section('css')
    <style>
        body{
            background-color: #f2f2f2
        }

        #logo-nav{
            color:#262C39
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

        #logo-down{
            color: #262C39
        }
    </style>
@endsection

@section('content')
<div class="container mt-5" style="clear: both">
    <div class="row justify-content-center text-center">
        <div class="col-md-3">
            <div class="card box-profile" id="bp-2">
                <div class="card-body">
                    <h5 class="card-title mt-2">Kelas Yang Dipelajari</h5>
                    <hr style="width: 45px;border:solid 1px #262C39;border-radius:5px;margin-top:-1px">
                    <img src="{{ asset("resource/image/course.png") }}" width="100%" height="143px" alt="">
                    <h4>{{ Auth::user()->course_registered->count() }}</h4>
                    <a href="{{ route("user.learned") }}">
                        <button class="btn-profile mb-2">Lihat Semua</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card box-profile" id="bp-3">
                <div class="card-body">
                    <h5 class="card-title mt-2">Kelas Yang Dibuat</h5>
                    <hr style="width: 45px;border:solid 1px #262C39;border-radius:5px;margin-top:-1px">
                    <img src="{{ asset("resource/image/course2.png") }}" width="67%" alt="">
                    <h4>{{ Auth::user()->courses->count() }}</h4>
                    <a href="{{ route("created-course.index") }}">
                        <button class="btn-profile mb-2">Lihat Semua</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection