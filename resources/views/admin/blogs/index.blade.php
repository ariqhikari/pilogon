@extends('templates_backend.home')

@section("title","List Blogs")

@section("sub-title","List Blogs")

@section('content')
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Pembuat</th>
                <th>Waktu Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $item => $result)
                <tr>
                    <td>{{ $item+$blogs->firstitem() }}</td>
                    <td>{{ $result->title }}</td>
                    <th>{{ $result->user->name }}</th>
                    <td>{{ $result->created_at->format("d M Y") }}</td>
                    <td>
                        <form action="{{ route("blogs.destroy",$result) }}" method="post">
                            @csrf
                            @method("delete")

                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $blogs->links() }}
@endsection