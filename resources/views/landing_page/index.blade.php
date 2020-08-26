@extends('landing_page.master')

@section("title","Home")

@section('logo')
    <img src="{{ asset("resource/image/logo_putih.png") }}" alt="" width="130px" style="margin-top: -10px;margin-left:30px">
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
<style>
    #image-mobile-profile, .user-sidebar{
        color: #818181 !important;
    }
    
    #box-mobile-profile{
        color: #818181 !important;
    }
</style>
@endsection

@section('content')
    
        {{-- awal header --}}
        <section class="section-header" style="clear: both">
            <div class="jumbotron">
                <div class="container">
                    <div class="row jsutify-content-center text-center">
                        <div class="col-md-12">
                            <img src="{{ asset("resource/image/lp2.png") }}" class="img-header" alt="Pilogon" data-aos="fade-up">
                            <div  data-aos="fade-up" data-aos-delay="150">
                                <h1 class="name-comp">Pilogon.</h1>
                                <h1 class="sub-name">Kelas Belajar Coding Untuk Semua Orang</h1>
                                <p class="p-lorem">Pilogon, website tempat belajar dan mengajar coding untuk semua orang yang berminat di bidang programming.</p>
                                <a href="#target" class="btn btn-header text-decoration-none"> 
                                    Jelajahi &raquo;
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    {{-- akhir header --}}
        
    {{-- awal sevices --}}
        <section class="section-services" data-aos="fade-up" data-aos-delay="500">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col">
                        <h1 class="cicung">
                            Pilogon
                        </h1>
                    </div>
                </div>
                <div class="row justify-content-center text-center">
                    <div class="col-md-8">
                        <h2 id="target" style="color:#ffffff">Hanya Companny Heheureuyan</h2>
                        <p style="color: #c9c9c9">Pilogon adalah sebuah startup yang dibangun oleh siswa smkn 4 bandung untuk memberikan pembelajar coding dan mempersilahkan user membuat kelas programmingnya sendiri.</p>
                    </div>
                </div>
            </div>
        </section>
    {{-- akhir services --}}
        <br>
    {{-- awal content 1 --}}
        <section class="section-content-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-5" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset("resource/image/lp1.png") }}" width="70%" id="lp2" alt="">
                    </div>
                    <div class="col-md-7" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="content1-title" style="color: #ffffff;">Bagikan Pengetahuan Kamu Disini</h3>
                        <p class="content1-sub" style="color: #c9c9c9;">Untuk Programmer yang berminat membagikan ilmunya disini secara sukarela, website kami merupakan tempat yang tepat, karena kami mempersilahkan kepada siapa saja yang mau meramaikan kasanah pemrograman di negri ini.</p>
                    </div>
                </div>
            </div>
        </section>
    {{-- akhir content 1 --}}
        <br><br>
    {{-- awal content 2 --}}
        <section class="section-content-2">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-md-5" data-aos="fade-up" data-aos-delay="100">
                        <div class="services" id="services-1">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            <h3 class="title-services" style="color: #ffffff">Kelas Gratis</h3>
                            <p class="sub-title-services" style="color: #c9c9c9">Kita bisa mendapatkan dan mempelajari kelas programming gratis dari para programmer di luar sana tanpa syarat dan ketentuan yang berlaku.</p>
                        </div>
                    </div>
                    <div class="col-md-5" data-aos="fade-up" data-aos-delay="200">
                        <div class="services" id="services-2">
                            <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                            <h3 class="title-services" style="color: #ffffff">Buat Kelasmu Sendiri</h3>
                            <p class="sub-title-services" style="color: #c9c9c9">Kita juga bisa memberikan ilmu programming kalian dengan membuat kelas disini, dengan cara yang tidak sulit.</p>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="row justify-content-center text-center">
                    <div class="col-md-5" data-aos="fade-up" data-aos-delay="300">
                        <div class="services" id="services-3">
                            <i class="fab fa-blogger-b" aria-hidden="true"></i>
                            <h3 class="title-services" style="color: #ffffff">Tulis Artikelmu</h3>
                            <p class="sub-title-services" style="color: #c9c9c9">Disini juga kita bisa menulis artikel terkait pemrograman ataupun hal yang berkaitan dengan dunia it.</p>
                        </div>
                    </div>
                    <div class="col-md-5" data-aos="fade-up" data-aos-delay="400">
                        <div class="services" id="services-4">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <h3 class="title-services" style="color: #ffffff">Bertanya Di Forum</h3>
                            <p class="sub-title-services" style="color: #c9c9c9">Jika kalian kebingungan atau merasa kesulitan ketika ada error yang muncul diprogram atau pun ketika kalian mempelajari kelas yang tersedia, kami menyediakan forum untuk berdiskusi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    {{-- akhir content 3 --}}
        <br><br>

    {{-- awal join --}}
        <section class="section-join">
            <div class="container">
                <div class="row">
                    <div class="col text-center" data-aos="fade-up">
                        <h3 style="color: #ffffff">Bagaimana Cara Bergabung Di Kelas Kita</h3>
                        <p style="margin-top: -10px;color:#c9c9c9">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div class="row text-center justify-content-center">
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset("resource/image/lp5.png") }}" style="margin-top: 0px;margin-bottom:30px" width="70%" alt="">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-3" id="how-to-1" data-aos="fade-up" data-aos-delay="100">
                        <i class="fas fa-user-plus" style="color: #43d6cf;font-size:35px"></i>
                        <h5 class="mt-2" style="color: #ffffff">Buat Akun Mu Sendiri</h5>
                        <p style="color: #c9c9c9">Pertama-tama buatlah akun pribadi kalian terlebih dahulu.</p>
                    </div>
                    <div class="col-md-3" id="how-to-2" data-aos="fade-up" data-aos-delay="200">
                        <i class="fas fa-person-booth" style="color: #43d6cf;font-size:35px"></i>
                        <h5 class="mt-2" style="color: #ffffff">Kunjungi Halaman Kelas</h5>
                        <p style="color: #c9c9c9">Kedua kalian kunjungi halaman kelas yang telah kami sediakan.</p>
                    </div>
                    <div class="col-md-3" id="how-to-3" data-aos="fade-up" data-aos-delay="300">
                        <i class="fas fa-book" style="color: #43d6cf;font-size:35px"></i>
                        <h5 class="mt-2" style="color: #ffffff">Lalu Pilih Kelas</h5>
                        <p style="color: #c9c9c9">Dan terakhir pilih kelas yang tersedia.</p>
                    </div>
                </div>
            </div>
        </section>
        {{-- akhir join --}}

        <br><br><br>
        
    {{-- awal team --}}
    <section class="section-team" data-aos="fade-up">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-10">
                <div class="splide" id="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <li class="splide__slide">
                                    <div class="row justify-content-center">
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col">
                                                    <img src="{{ asset("resource/image/musin.jpeg") }}" width="150px" height="150px" class="rounded-circle" alt="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mt-3">
                                                    <h4 style="color: #ffffff">Muhsin Askari</h4>
                                                    <h6 style="margin-top: -10px;color:#43d6cf">Ketua Tim Pilogon</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <p id="ceramah" style="color: #c9c9c9">
                                                " Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nobis explicabo tenetur esse sed, dolorum, vel rem, iusto veniam harum quidem quas quasi quod quae. Obcaecati fuga commodi perspiciatis natus voluptas. "
                                            </p>
                                            <a href="" style="text-decoration: none;color:#43d6cf !important">
                                                <h6 id="ceramah2">Kunjungi Instagram <i class="fab fa-instagram"></i></h6>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li class="splide__slide">
                                    <div class="row justify-content-center">
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col">
                                                    <img src="{{ asset("resource/image/rasel3.jpg") }}" width="150px" height="150px" class="rounded-circle" alt="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mt-3">
                                                    <h4 style="color: #ffffff">Rachel Sabardila</h4>
                                                    <h6 style="margin-top: -10px;color:#43d6cf">Product Development</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <p id="ceramah" style="color: #c9c9c9">
                                                " Itu teh foto si rasel sabardila salah satu murid kebanggaan smkn 4 bandung, katanamah pengen juara lks biar dapet beasiswa di itb, tapi da sok horeaman ngodingna:) jadi langsung kerja tapi da gpp kalo jadi programmer di perusahaan bagusmah apalagi kalo yang punya perusaannya punya anak perempuan bening:V. "
                                            </p>
                                            <a href="" style="text-decoration: none;color:#43d6cf !important">
                                                <h6 id="ceramah2">Kunjungi Instagram <i class="fab fa-instagram"></i></h6>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li class="splide__slide">
                                    <div class="row justify-content-center">
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col">
                                                    <img src="{{ asset("resource/image/ariq.jpeg") }}" width="150px" height="150px" class="rounded-circle" alt="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mt-3">
                                                    <h4 style="color: #ffffff">Ariq Hikari</h4>
                                                    <h6 style="margin-top: -10px;color:#43d6cf">Product Development</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <p id="ceramah" style="color: #c9c9c9">
                                                " Nama saya Ariq Hikari Hidayat. Saya adalah siswa SMK 4 Bandung jurusan RPL (Rekayasa Perangkat Lunak). Saat ini saya sedang bergelut di dunia pemrograman khususnya Web Development. Hobi saya, ngulik tentang teknologin, nonton film dan main game. "
                                            </p>
                                            <a href="" style="text-decoration: none;color:#43d6cf !important">
                                                <h6 id="ceramah2">Kunjungi Instagram <i class="fab fa-instagram"></i></h6>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li class="splide__slide">
                                    <div class="row justify-content-center">
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col">
                                                    <img src="{{ asset("resource/image/bilal.jpg") }}" width="150px" height="150px" class="rounded-circle" alt="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mt-3">
                                                    <h4 style="color: #ffffff">Bilal Arief</h4>
                                                    <h6 style="margin-top: -10px;color:#43d6cf">Product Development</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <p id="ceramah" style="color: #c9c9c9">
                                                " Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nobis explicabo tenetur esse sed, dolorum, vel rem, iusto veniam harum quidem quas quasi quod quae. Obcaecati fuga commodi perspiciatis natus voluptas. "
                                            </p>
                                            <a href="" style="text-decoration: none;color:#43d6cf !important">
                                                <h6 id="ceramah2">Kunjungi Instagram <i class="fab fa-instagram"></i></h6>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li class="splide__slide">
                                    <div class="row justify-content-center">
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col">
                                                    <img src="{{ asset("resource/image/nopal.jpeg") }}" width="150px" height="150px" class="rounded-circle" alt="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mt-3">
                                                    <h4 style="color: #ffffff">Naufal Fachrudin</h4>
                                                    <h6 style="margin-top: -10px;color:#43d6cf">Marketing</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <p id="ceramah" style="color: #c9c9c9">
                                                " Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nobis explicabo tenetur esse sed, dolorum, vel rem, iusto veniam harum quidem quas quasi quod quae. Obcaecati fuga commodi perspiciatis natus voluptas. "
                                            </p>
                                            <a href="" style="text-decoration: none;color:#43d6cf !important">
                                                <h6 id="ceramah2">Kunjungi Instagram <i class="fab fa-instagram"></i></h6>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li class="splide__slide">
                                    <div class="row justify-content-center">
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col">
                                                    <img src="{{ asset("resource/image/rapa.jpeg") }}" width="150px" height="150px" class="rounded-circle" alt="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col mt-3">
                                                    <h4 style="color: #ffffff">Khairulrafa Erlangga</h4>
                                                    <h6 style="margin-top: -10px;color:#43d6cf">Product Manager</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <p id="ceramah" style="color: #c9c9c9">
                                                " Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nobis explicabo tenetur esse sed, dolorum, vel rem, iusto veniam harum quidem quas quasi quod quae. Obcaecati fuga commodi perspiciatis natus voluptas. "
                                            </p>
                                            <a href="" style="text-decoration: none;color:#43d6cf !important">
                                                <h6 id="ceramah2">Kunjungi Instagram <i class="fab fa-instagram"></i></h6>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- akhir team --}}   
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@2.4.11/dist/js/splide.min.js" integrity="sha256-qWNguy5xdG3YZHjlow1N55CfiX9ws3LiW+x9SuLK1GA=" crossorigin="anonymous"></script>
    <script>
        new Splide( '#splide' ).mount();
    </script>
@endsection