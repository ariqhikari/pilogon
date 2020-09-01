@extends('landing_page.master')

@section("title","View Cover Kelas - Pilogon")

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
    <div class="container" style="clear: both">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route("user.show",Auth::user()->slug) }}">{{ Auth::user()->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route("created-course.index") }}">Kelas Yang Dibuat</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $covercourse->title }}</li>
        </ol>
        </nav>
        <div class="row justify-content-center text-center">
            <div class="col-md-12" style="background-repeat:no-repeat;background-size:cover;background-position:center;width: 90%;height:250px;background-image:url('{{ Storage::url($covercourse->thumbnail) }}');border-radius:15px">
            </div>
        </div>
        <div class="row justify-content-center mt-5 text-center">
            <div class="col-md-3" id="cover1">
                <div class="card box-profile">
                    <div class="card-body">
                        <div style="float:left;margin-top:5px;margin-left:30px">
                            <h5 class="card-title">Level</h5>
                            <p class="card-text" style="margin-top: -10px">{{ $covercourse->level }}</p>
                        </div>
                        <i class="fas fa-angle-double-up" style="font-size: 60px"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3" id="cover2">
                <div class="card box-profile">
                    <div class="card-body">
                        <div style="float:left;margin-top:5px;margin-left:30px">
                            <h5 class="card-title">Pendaftar</h5>
                            <p class="card-text" style="margin-top: -10px">{{ $covercourse->userRegistered->count() }}</p>
                        </div>
                        <i class="fas fa-users" style="font-size: 60px"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3" id="cover3">
                <div class="card box-profile">
                    <div class="card-body">
                        <div style="float:left;margin-top:5px;margin-left:30px">
                            <h5 class="card-title">Modules</h5>
                            <p class="card-text" style="margin-top: -10px">{{ $covercourse->modules->count() }}</p>
                        </div>
                        <i class="fas fa-swatchbook" style="font-size: 60px"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center mt-5 justify-content-center">
            <div class="col-md-10">
                <h2>{{ $covercourse->title }}</h2>
                <span style="color: #5f5f5f">
                    {!! substr($covercourse->description,0,300) !!}
                </span>
            </div>
        </div>
        <hr>
        <div class="row text-center justify-content-center">
            <div class="col-md-10 mt-3">
                <h3>Modules Belajar</h3>
                <p style="color: #5f5f5f">Dibawah ini adalah kumpulan module atau materi dari kelas {{ $covercourse->title }}.</p>
            </div>
        </div>
        <div class="row text-center justify-content-center">
            <div class="col-md-6 mt-4">
                <div class="card box-profile">
                    <div class="card-body">
                        <table class="table">
                            <thead style="background-color: #262C39;color:white">
                                <tr>
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $row = 0;
                                @endphp
                                @if ($covercourse->modules->count() <= 0)
                                    <tr>
                                        <td colspan="6">
                                            <img src="{{ asset("resource/image/null.png") }}" width="200px" alt="">
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($covercourse->modules as $item)
                                        <tr>
                                            <td>{{ $row+=1 }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>
                                                <a href="{{ route("modules.edit",[$item->id,$covercourse->slug]) }}">
                                                    <i class="fas fa-pencil-alt" style="color: #262C39;margin-right:20px"></i>
                                                </a>
                                                <i class="fas fa-trash" style="color: #262C39;cursor: pointer" onclick="confirmDelete('{{ $item->id }}')"></i>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        @if ($covercourse->modules->count() > 0)
                            <a href="{{ route("modules.show",[$covercourse->modules[0]->id,$covercourse->slug]) }}" class="text-decoration-none">
                                <button class="btn btn-dark btn-block" style="background-color: #262C39" type="button"><i class="fas fa-eye"></i> Preview</button>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-4">
                <div class="card box-profile">
                    <div class="card-body">
                        @if (!isset($course_update))
                            <form action="{{ route("modules.store") }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input id="title" class="form-control @error("title") is-invalid @enderror" type="text" name="title" placeholder="Judul" style="background-color: transparent">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <textarea name="materi" class="@error("materi") is-invalid @enderror" id="materi" cols="30" rows="10">
                                        isi materi disini
                                    </textarea>
                                    @error('materi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="alert alert-info" role="alert">
                                        Source Code(isi dalam format .zip dan boleh kosong) 
                                    </div>
                                    <input type="file" name="code" class="form-control @error("code") is-invalid @enderror" id="" style="background-color: transparent">
                                    </textarea>
                                    @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="hidden" name="slug" value="{{ $covercourse->slug }}">
                                <button class="btn btn-dark btn-block" style="background-color: #262C39" type="submit">Tambah Module</button>
                            </form>
                        @else
                            <form action="{{ route("modules.update",[$course_update->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method("patch")

                                <div class="form-group">
                                    <input id="title" class="form-control @error("title") is-invalid @enderror" type="text" name="title" placeholder="judul" style="background-color: transparent" value="{{ $course_update->title }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <textarea name="materi" class="@error("materi") is-invalid @enderror" id="materi" cols="30" rows="10">
                                        {{ $course_update->materi }}
                                    </textarea>
                                    @error('materi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="alert alert-info" role="alert">
                                        kosongkan jika tidak akan diganti
                                    </div>
                                    <input type="file" name="code" class="form-control @error("code") is-invalid @enderror" id="" style="background-color: transparent">
                                    </textarea>
                                    @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="hidden" name="slug" value="{{ $covercourse->slug }}">
                                <button class="btn btn-dark btn-block" style="background-color: #262C39" type="submit">Edit Module</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'materi',{
                filebrowserUploadUrl: "{{route('class.image', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });

            function confirmDelete(id) {
            swal({
                title: "Kamu Yakin?",
                text: "Module Ini akan di hapus",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "/modules/"+ id +"/delete"
                } else {
                    swal("Data Kamu Aman");
                }
                });
        }
        </script>
@endsection