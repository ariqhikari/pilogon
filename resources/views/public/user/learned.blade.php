@extends('landing_page.master')


@section("title","Kelas yang dipelajari - Pilogon")

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
        <div class="col-md-5">
            <img src="{{ asset("resource/image/course.png") }}" style="margin-top: -40px" width="60%" alt="">  
        </div>
    </div>
    
    <div class="row justify-content-center text-center">
        <div class="col-md-8">
            <h3>Kelas Yang Dipelajari</h3>
            <h5 style="margin-top: -10px;color:#858585">Tersedia {{ Auth::user()->course_registered->count() }} Kelas Untuk Dipelajari</h5>
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach (Auth::user()->course_registered as $item)
            <div class="col-md-4 mt-4">
                <a href="{{ route("class.show",$item) }}" style="text-decoration: none">
                    <img src="{{ Storage::url($item->thumbnail) }}" height="200px" width="100%" style="border-radius:5px" alt="">
                </a>
                <h5 style="margin-top: 14px;color:#262C39">{{ $item->title }}</h5>
                <h5 style="color: #838383;text-transform:capitalize;margin-top:-8px">{{ $item->user->name }}</h5>
            </div>
        @endforeach
        {{ $courses->links() }}
    </div>
</div>
@endsection