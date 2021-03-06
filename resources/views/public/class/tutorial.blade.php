@extends('landing_page.master')

@section("title","View Course - Pilogon")

@section('logo')
    <img src="{{ asset("resource/image/logo tulisan.png") }}" alt="" width="130px" style="margin-top: -10px;margin-left:30px">
@endsection

@section('css')
    <style>
        body{
            background-color: #f2f2f2
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

        .scroll{
            overflow: scroll;
            height: 500px;
            width: 100%;
        }
        .modul a.active{
            color: #59e0c0;
        }
    </style>
@endsection

@section('content')
    <div class="container" style="clear: both">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route("class.show",$covercourse->slug) }}">{{ $covercourse->title }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $module->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <div class="col-md-12" style="width:100%;border-radius:15px;height:280px;background-position:center;background-size:cover;background-repeat:no-repeat;background-image: url('{{ Storage::url($covercourse->thumbnail) }}')">
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-3" id="scroll">
                <div class="card" style="box-shadow:0px 0px 2px 1px rgb(223, 223, 223);background-color:#f2f2f2">
                    <div class="card-body">
                        <h4 style="margin-left: 7px">Daftar Modul</h4>
                        <hr>
                        <div class="scroll modul">
                            @foreach ($daftar_module as $item)
                                <a href="{{ route("class.belajar",[$covercourse->slug,$item->id]) }}" class="{{ ($item->id == $module->id) ? 'active' : ''  }}">
                                    <h5>{{ $item->title }}</h5>
                                </a>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card" style="background-color: #f2f2f2;box-shadow:0px 0px 2px 1px rgb(223, 223, 223)">
                    <div class="card-body" style="">
                        <div style="width: 92%;margin:auto">
                            <h3 style="margin-top: 30px">{{ $module->title }}</h3>
                            <p>
                                {!! $module->materi !!}
                            </p>
                            @if ($module->code != null)
                                <a href="{{ route("modules.download",$module) }}">
                                    <button class="btn btn-dark btn-block mt-4" style="background: #262C39" type="button"><i class="fas fa-box"></i> Download Source Code</button>
                                </a>
                            @endif
                            <hr style="margin-top: 35px">
                            <div style="margin-top: 30px">
                                @if ($covercourse->modules[0]->id != $module->id)
                                    <a href="{{ route("class.belajar",[$covercourse->slug,$covercourse->modules[$index-1],]) }}">
                                        <button class="btn btn-dark btn-sm float-left" style="background: #262C39" type="button"><i class="fas fa-long-arrow-alt-left"></i> Materi Sebelumnya</button>
                                    </a>
                                @endif
                                @if ($covercourse->modules[$covercourse->modules->count()-1]->id != $module->id)
                                    <a href="{{ route("class.belajar",[$covercourse->slug,$covercourse->modules[$index+1]]) }}">
                                        <button class="btn btn-dark btn-sm float-right" style="background: #262C39" type="button">Materi Selanjutnya <i class="fas fa-long-arrow-alt-right"></i></button>
                                    </a>
                                @endif
                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection