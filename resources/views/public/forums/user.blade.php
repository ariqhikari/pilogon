@extends('landing_page.master')


@section("title","Pertanyaan Forum")

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

        .scroll{
            width: 100%;
            height:600px;
            overflow: scroll;
            background: transparent;
            border-radius: 15px
        }
    </style>
@endsection

@section('content')
<div class="container mt-5" style="clear: both">
    <div class="row justify-content-center text-center">
        <div class="col-md-5">
            <img src="{{ asset("resource/image/forum-user.png") }}" style="margin-top: -40px" width="60%" alt="">  
        </div>
    </div>
    <div class="row justify-content-center text-center">
        <div class="col-md-8">
            <h3>Pertanyaan Forum</h3>
            <h5 style="margin-top: -10px;color:#808080">{{ Auth::user()->name }}</h5>
        </div>
    </div>
    <div class="row justify-content-center text-center mt-3 mb-5">
        <div class="col-md-3">
            <h4>{{ Auth::user()->forums->count() }}</h4>
            <h5 style="color: #808080">Pertanyaan</h5>
        </div>
        <div class="col-md-3">
            <h4>{{ Auth::user()->total_jawaban() }}</h4>
            <h5 style="color: #808080">Jawaban</h5>
        </div>
        <div class="col-md-3">
            <h4>{{ Auth::user()->comments->count() }}</h4>
            <h5 style="color: #808080">Memberi Jawaban</h5>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card box-profile">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <table class="table table-responsive">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Judul</th>
                                        <th>Waktu</th>
                                        <th>Penanya</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($forums->count() > 0)
                                        @foreach ($forums as $item => $result)
                                            <tr>
                                                <td>{{ $item+$forums->firstitem() }}</td>
                                                <td>{{ $result->title }}</td>
                                                <td>{{ $result->created_at->format("d M Y") }}</td>
                                                <td>{{ $result->user->name }}</td>
                                                <td>
                                                    <a href="{{ route("forum.edit",$result->slug) }}">
                                                        <i class="fas fa-pencil-alt" style="color: #262C39;margin-right:10px"></i>
                                                    </a>
                                                    <i class="fas fa-trash" style="color: #262C39;cursor: pointer" onclick='confirmDelete("{{ $result->slug }}")' slug-crs="{{ $result->slug }}"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <center>
                                                    <img src="{{ asset("resource/image/null.png") }}" alt="" width="100%">
                                                </center>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            {{ $forums->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6" id="box-forum-user-2">
            <h3 class="text-center">Jawaban</h3>
            <hr>
            <div class="scroll">
                @if (Auth::user()->total_jawaban() > 0)
                    @foreach (Auth::user()->forums as $item)
                        @foreach ($item->comments as $item2)
                            <div class="row mb-3">
                                <div class="col">
                                    <a href="{{ route("forum.show",$item2->forum->slug) }}" style="text-decoration:none;color:#1e1e1e">
                                        <div class="card box-profile" style="height: 85px">
                                            <div class="card-body">
                                                <div>
                                                    <img src="{{ Storage::url($item2->user->foto) }}" style="float:left;margin-top:-7px;margin-right:20px;border-radius:50%" alt="" width="60px" height="60px">
                                                    <h6>{!! substr($item2->comment,0,40) !!}</h6>
                                                    <h6 style="color:grey;margin-top:-10px;">{{ $item2->created_at->diffForHumans() }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @else
                    <center>
                        <img src="{{ asset("resource/image/null.png") }}" alt="" width="200px">
                    </center>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        function confirmDelete(slug) {
            swal({
                title: "Kamu Yakin?",
                text: "Menghapus pertanyaan dari forum",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/forum/"+ slug +"/delete"
                } else {
                    swal("Data Kamu Aman");
                }
                });
        }
    </script>
@endsection