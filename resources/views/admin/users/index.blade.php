@extends('templates_backend.home')

@section("title","List User")

@section("sub-title","List User")

@section('action-search')
    action="{{ route("admin.userSearch") }}"
@endsection

@section('icon-search')
    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
@endsection

@section('search')
    <div class="search-element">
        <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250" name="keyword">
        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
    </div>
@endsection

@section('content')
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Bergabung</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $item => $result)
                <tr>
                    <td>
                        {{ $item+$users->firstitem() }}
                    </td>
                    <td>
                        @if ($result->foto != null)
                            <img src="{{ Storage::url($result->foto) }}" alt="" class="img-thumbnail mt-2" width="100px" srcset="">
                        @else
                            <img src="{{ asset("resource/image/profile-blank.webp") }}" alt="" class="img-thumbnail" width="100px" srcset="">
                        @endif
                    </td>
                    <td>
                        {{ $result->name }}
                    </td>
                    <td>
                        {{ $result->created_at->format("d M Y") }}
                    </td>
                    <td>
                        @if ($result->permission == "admin")
                            <span class="badge badge-pill badge-info">{{ $result->permission }}</span>
                        @else
                            <span class="badge badge-pill badge-warning">{{ $result->permission }}</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route("user.destroy",$result) }}" method="post">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection