@extends('landing_page.master')

@section("title","Kelas")

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
                <h1 id="title-class">Kelas Online</h1>
                <p id="sub-title-class">Halaman kelas tempat kita mencari dan mempelajari kelas-kelas yang telah dibuat oleh para programmer lain di luar sana secara gratis.</p>
                <a href="#kelas" id="btn-class" class="btn btn-class">Mulai Belajar</a>
            </div>
            <div class="col-md-5 text-center" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset("resource/image/lp4.png") }}" width="70%" alt="">
            </div>
        </div>
        <div class="row mt-5 justify-content-center">
            <div class="col-md-12 mt-4">
                <div class="row">
                    <div class="col">
                        <div class="card box-profile" data-aos="fade-up" data-aos-delay="300">
                            <div class="card-body">
                                <form action="{{ route("class.search") }}" method="post">
                                    @csrf
                                    <div class="form-group d-flex align-items-center">
                                        <input id="my-input" style="background-color: transparent;" class="form-control" type="text" name="keyword" placeholder="Cari kelas">
                                        <button type="submit" style="background-color: transparent;border:none">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                                <h5 style="margin-top: 20px">Filter Kelas</h5>
                                <form action="{{ route("class.filter") }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-group">
                                            <select id="my-select" class="form-control" name="level" style="background-color: transparent" required>
                                                <option value="">Pilih Level</option>
                                                <option value="beginner">Beginner</option>
                                                <option value="intermediate">Intermediate</option>
                                                <option value="professional">Professional</option>
                                            </select>
                                        </div><button type="submit" class="btn btn-dark btn-block" style="background-color: #262C39">Filter</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" id="kelas">
                <div class="container">
                    <div class="row">
                        @if ($courses->count() <= 0)
                            <div class="col-md-12 text-center" data-aos="fade-up" data-aos-delay="400">
                                <img src="{{ asset("resource/image/null.png") }}" width="250px" alt="">
                            </div>
                        @else
                            @foreach ($courses as $item)
                                <div class="col-md-6 col-lg-4 mt-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration + 4 }}00">
                                    <a href="{{ route("class.show",$item) }}" style="text-decoration: none">
                                        <div class="card box-profile" id="box-course-8" style="max-height: 500px">
                                            <div class="card-body">
                                                <img src="{{ Storage::url($item->thumbnail) }}" width="100%" style="border-radius:10px" alt="">
                                                <div style="margin-top: 20px">
                                                    <h6 style="float: left;margin-left:30px;color:#555555" class="mx-auto"><i class="fas fa-scroll"></i>{{ $item->modules->count() }} Modules</h6>
                                                    <h6 style="float: right;margin-right:30px;text-transform:capitalize;color:#555555" class="mx-auto"><i class="fas fa-angle-double-up"></i> {{ $item->level }}</h6>
                                                </div>
                                                <br>
                                                <h4 style="clear: both;text-align:center;color:#262C39">{{ $item->title }}</h4>
                                                <div>
                                                    <article style="color:grey;clear:both;text-align:justify">{!! substr($item->description,0,80) !!}...</article>
                                                </div>
                                                
                                                <center>
                                                    @foreach ($item->categorys as $item2)
                                                    <span class="badge badge-dark">{{ $item2->name }}</span>
                                                    @endforeach
                                                </center>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-2">
                            {{ $courses->links() }}
                        </div>
                    </div>  
                </div>
            </div>
        </div>
        <div class="row mt-5 justify-content-center text-center">
            <div class="col-md-12" style="background-color: #262C39;width:94%;height:auto;border-radius:10px">
                <br>
                <h3 style="color: #f7f7f7">Buat Kelasmu Sendiri</h3>
                <p style="color: rgb(202, 202, 202);margin-left:50px;margin-right:50px">Kalian ingin memberikan ilmu ataupun pengetahuan programming kalian mejadi sebuah kelas online? klik tombol dibawah untuk membuat kelas kalian sendiri.</p>
                <a href="{{ route("class.create_cover") }}" class="btn btn-header">
                    Buat Kelas
                </a>
                <br> <br>
            </div>
        </div>
    </div>
@endsection