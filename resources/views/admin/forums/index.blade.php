@extends('templates_backend.home')

@section("title","List Forums")

@section("sub-title","List Forums")

@section('content')
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Masalah</th>
                <th>Pembuat</th>
                <th>Waktu Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($forums as $item => $result)
                <tr>
                    <td>{{ $item+$forums->firstitem() }}</td>
                    <td>{{ $result->title }}</td>
                    <th>{{ $result->user->name }}</th>
                    <td>{{ $result->created_at->format("d M Y") }}</td>
                    <td>
                        <form action="{{ route("forum.destroy",$result) }}" method="post">
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
    {{ $forums->links() }}
@endsection