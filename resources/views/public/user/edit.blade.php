@extends('landing_page.master')

@section("title","Edit User - Pilogon")

@section('logo')
    <img src="{{ asset("resource/image/logo tulisan.png") }}" alt="" width="130px" style="margin-top: -10px;margin-left:30px"
    >
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
    <div class="container" style="clear:both;">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form action="{{ route("user.update",$user) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("patch")
                <center>
                    @if ($user->foto != null)
                        <img src="{{ Storage::url($user->foto) }}" width="130px" height="130px" class="rounded-circle mb-3" alt="">
                    @else
                        <img src="{{ asset("resource/image/profile-blank.webp") }}" width="130px" height="130px" class="rounded-circle mb-3" alt="">
                    @endif
                </center>
                <div class="alert alert-warning" role="alert">
                    Kosongkan Jika Tidak Akan Diganti
                </div>
                <div class="form-group">
                    <input id="foto" class="form-control" type="file" name="foto" style="background-color: transparent">
                </div>  
                <hr>
            </div>
            <div class="col-md-8">
                <h5>Akun</h5>
                <div class="form-group">
                    <label for="name">Username :</label>
                    <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ $user->name }}" style="background-color: transparent">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input id="email" class="form-control @error('email') is-invalid @enderror" type="name" readonly name="email" value="{{ $user->email }}" style="background-color: transparent">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <hr>
                <h5>Data Pribadi</h5>
                <div class="form-group">
                    <label for="telepon">No Telepon :</label>
                    <input id="telepon" class="form-control @error('telepon') is-invalid @enderror" type="text" name="telepon" value="{{ $user->profiles[0]->no_telepon }}" style="background-color: transparent">
                    @error('telepon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kota">Kota / Kabupaten Saat Ini :</label>
                    <input id="kota" class="form-control @error('kota') is-invalid @enderror" type="text" name="kota" value="{{ $user->profiles[0]->kota }}" style="background-color: transparent">
                    @error('kota')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="biodata">Biodata :</label>
                    <textarea name="biodata" class="form-control @error('biodata') is-invalid @enderror" id="" cols="30" rows="6" style="background-color: transparent">
                        {{ $user->profiles[0]->biodata }}
                    </textarea>
                    @error('biodata')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kelamin">Jenis Kelamin :</label>
                    <select name="kelamin" id="" class="form-control @error('kelamin') is-invalid @enderror" style="background-color: transparent">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="pria" {{ ($user->profiles[0]->jenis_kelamin == "pria") ? "selected" : '' }}>Pria</option>
                        <option value="wanita" {{ ($user->profiles[0]->jenis_kelamin == "wanita") ? "selected" : '' }}>Wanita</option>
                    </select>
                    @error('kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir : </label>
                    <input id="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" type="text" name="tempat_lahir" value="{{ $user->profiles[0]->tempat_lahir }}" style="background-color: transparent">
                    @error('tempat_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir : </label>
                    <input id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" type="date" name="tanggal_lahir" value="{{ $user->profiles[0]->tanggal_lahir }}" style="background-color: transparent">
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="asal_sekolah">Asal Sekolah : </label>
                    <input id="asal_sekolah" class="form-control @error('asal_sekolah') is-invalid @enderror" type="text" name="asal_sekolah" value="{{ $user->profiles[0]->asal_sekolah }}" style="background-color: transparent">
                    @error('asal_sekolah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="skill">Skill Yang Dimiliki : </label>
                    <input id="skill" class="form-control @error('skill') is-invalid @enderror" type="text" name="skill" value="{{ $user->profiles[0]->skill }}" style="background-color: transparent">
                    @error('skill')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <hr>
                <h5>Sosial Media</h5>
                <div class="form-group">
                    <label for="instagram">Url Instagram : </label>
                    <input id="instagram" class="form-control @error('instagram') is-invalid @enderror" type="text" name="instagram" value="{{ $user->profiles[0]->instagram }}" style="background-color: transparent">
                    @error('instagram')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="github">Url Github : </label>
                    <input id="github" class="form-control @error('github') is-invalid @enderror" type="text" name="github" value="{{ $user->profiles[0]->github }}" style="background-color: transparent">
                    @error('github')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="facebook">Url Facebook : </label>
                    <input id="facebook" class="form-control @error('facebook') is-invalid @enderror" type="text" name="facebook" value="{{ $user->profiles[0]->facebook }}" style="background-color: transparent">
                    @error('facebook')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <hr>
                <div class="alert alert-warning" role="alert">
                    Form Dibawah Isi Bila Akan Anda Ganti!!
                </div>
                <div class="form-group">
                    <label for="password">Password : </label>
                    <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" style="background-color: transparent">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block" style="border-radius: 5px;
                border: none;background-color: #262C39;color: #ffffff;font-size: 20px;">
                    <i class="fas fa-save"></i> Edit Profile
                </button>
            </form>
            </div>
        </div>
    </div>
@endsection