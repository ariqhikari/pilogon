@extends('templates_backend.home')

@section("title","List Courses")

@section("sub-title","List Courses")

@section('content')
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Course</th>
                <th>Pembuat</th>
                <th>Waktu Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $item => $result)
                <tr>
                    <td>{{ $item+$courses->firstitem() }}</td>
                    <td>{{ $result->title }}</td>
                    <th>{{ $result->user->name }}</th>
                    <td>{{ $result->created_at->format("d M Y") }}</td>
                    <td>
                        <a href="{{ route("admin.drop",$result) }}">
                            <button class="btn btn-danger" type="button"><i class="fas fa-trash"></i></button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $courses->links() }}
@endsection