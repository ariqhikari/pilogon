@extends('landing_page.master')

@section("title","Kelas yang dibuat - Pilogon")

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
    </style>
@endsection

@section('content')
    <div class="container mt-5" style="clear: both">
        <div class="row justify-content-center text-center">
            <div class="col-md-5">
                <img src="{{ asset("resource/image/course2.png") }}" style="margin-top: -40px" width="50%" alt="">  
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-md-8">
                <h3>Kelas Yang Dibuat</h3>
                <h5 style="margin-top: -10px;color:#6d6d6d">{{ Auth::user()->name }}</h5>
            </div>
        </div>
        <div class="row justify-content-center text-center mt-3 mb-5">
            <div class="col-4 col-md-3">
                <h4>{{ Auth::user()->courses->count() }}</h4>
                <h5 style="color: #6d6d6d">Kelas</h5>
            </div>
            <div class="col-4 col-md-3">
                <h4>{{ Auth::user()->modules() }}</h4>
                <h5 style="color: #6d6d6d">Modul</h5>
            </div>
            <div class="col-4 col-md-3">
                <h4>{{ Auth::user()->pendaftar() }}</h4>
                <h5 style="color: #6d6d6d">Pendaftar</h5>
            </div>
        </div>
        
        <div class="row justify-content-center text-center">
            <div class="col-md-8">
                <div class="card box-profile">
                    <div class="card-body"> 
                        @if ($courses->count() <= 0)
                            <table class="table table-responsive-sm">
                        @else
                            <table class="table table-responsive">
                        @endif
                            <thead style="background-color: #262C39;color:white">
                                <tr>
                                    <th>Status</th>
                                    <th>Pembuat</th>
                                    <th>Judul</th>
                                    <th>Level</th>
                                    <th>Modules</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($courses->count() <= 0)
                                    <tr>
                                        <td colspan="6">
                                                <img src="{{ asset("resource/image/null.png") }}" width="200px" alt="">
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($courses as $item)
                                        <tr>
                                            <td>
                                                @if ($item->status == 0)
                                                    <span class="badge badge-pill badge-danger">Belum Diupload</span>
                                                @else
                                                    <span class="badge badge-pill badge-success">Terupload</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->user->name }}
                                            </td>
                                            <td>
                                                {{ $item->title }}
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-dark">{{ $item->level }}</span>
                                            </td>
                                            <td>
                                                {{ $item->modules->count() }}
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{ route("created-course.edit",$item->slug) }}" class="text-decoration-none">
                                                    <i class="fas fa-pencil-alt" style="color: #262C39;margin-right:10px"></i>
                                                </a>
                                                <a href="{{ route("created-course.show",$item->slug) }}" class="text-decoration-none">
                                                    <i class="fas fa-eye" style="color: #262C39;margin-right:10px"></i>
                                                </a>
                                                <i class="fas fa-trash" style="color: #262C39;cursor: pointer" onclick='confirmDelete("{{ $item->slug }}")' slug-crs="{{ $item->slug }}"></i>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <a href="{{ route('class.create_cover') }}" class="btn btn-dark btn-block" style="background-color: #262C39">Buat Kelas</a>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-2">
                            {{ $courses->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card box-profile">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route("verifikasi.store") }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <select id="my-select" class="form-control @error('cover_course_id') is-invalid @enderror" name="cover_course_id">
                                            <option selected disabled>Pilih Course Untuk Diverifikasi</option>
                                            @foreach ($courses as $item)
                                                @if ($item->status == 0)
                                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('cover_course_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" style="background-color: #262C39" class="btn btn-dark btn-block">Verifikasi Course</button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route("verifikasi.drop") }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <select id="my-select" class="form-control @error('cover_course_id') is-invalid @enderror" name="cover_course_id">
                                            <option selected disabled>Pilih Course Untuk Ditarik Kembali</option>
                                            @foreach ($courses as $item)
                                                @if ($item->status == 2)
                                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('cover_course_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" style="background-color: #262C39" class="btn btn-dark btn-block">Tarik Kembali Course</button>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="text-center mt-4">Riwayat</h5>
                                <table class="table">
                                    <tbody>
                                        @foreach ($courses as $item)
                                            @if ($item->user_id == Auth::id())
                                                @foreach ($verifikasi as $item2)
                                                    @if ($item->id == $item2->cover_course_id)
                                                        <tr>
                                                            <td>
                                                                @if ($item2->status == 0)
                                                                    <span class="badge badge-pill badge-primary">Menunggu Verifikasi</span>
                                                                @endif
                                                                @if ($item2->status == 1)
                                                                    <span class="badge badge-pill badge-danger">Tidak Disetujui</span>
                                                                @endif
                                                                @if ($item2->status == 2)
                                                                    <span class="badge badge-pill badge-success">Terupload</span>
                                                                @endif
                                                                @if ($item2->status == 3)
                                                                    <span class="badge badge-pill badge-dark">Drop</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $item2->course->title }}</td>
                                                            <td>{{ $item2->created_at->diffForHumans() }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ($verifikasi->count() != 0)
                                    <center>
                                        <a href="{{ route("verifikasi.delete") }}">
                                            <button class="btn btn-danger btn-sm" type="button"><i class="fas fa-trash"></i> Hapus Riwayat</button>
                                        </a>
                                    </center>
                                @else
                                    <center>
                                        <p class="btn btn-dark btn-sm" style="background-color: #262C39">History Kosong</p>
                                    </center>
                                @endif
                            </div>
                        </div>
                    </div>
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
                text: "Semua Modul dan cover akan dihapus permanen",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/created-course/"+ slug +"/delete-course"
                } else {
                    swal("Data Kamu Aman");
                }
                });
        }
    </script>
@endsection