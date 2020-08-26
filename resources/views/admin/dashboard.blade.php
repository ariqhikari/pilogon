@extends('templates_backend.home')

@section("title","Dashboard")

@section("sub-title","Dashboard")

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-left">
                            <h4>Courses</h4>
                            <h5 style="text-align: center">{{ $courses }}</h5>
                        </div>
                        <i class="fas fa-swatchbook" style="float: right;font-size:50px"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-left">
                            <h4>Articles</h4>
                            <h5 style="text-align: center">{{ $courses }}</h5>
                        </div>
                        <i class="fab fa-blogger-b" style="float: right;font-size:50px"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-left">
                            <h4>Forum</h4>
                            <h5 style="text-align: center">{{ $courses }}</h5>
                        </div>
                        <i class="fas fa-users" style="float: right;font-size:50px"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-light">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Course</th>
                                    <th>Waktu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($verifikasi as $item => $result)
                                    <tr>
                                        <td>{{ $item+$verifikasi->firstitem() }}</td>
                                        <td>{{ $result->course->title }}</td>
                                        <td>{{ $result->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route("admin.upload",$result->id) }}" class="text-decoration-none">
                                                <button class="btn btn-success" type="button"><i class="fas fa-upload"></i></button>
                                            </a>
                                            <a href="{{ route("admin.tolak",$result->id) }}" class="text-decoration-none">
                                                <button class="btn btn-danger" type="button"><i class="fas fa-trash"></i></button>
                                            </a>
                                            <a href="{{ route("modules.show",[$result->course->modules[0]->id,$result->course->slug]) }}" class="text-decoration-none">
                                                <button class="btn btn-warning" type="button"><i class="fas fa-eye"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $verifikasi->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection