@extends('templates_backend.home')

@section("title","List Categorys")

@section("sub-title","List Categorys")

@section('action-search')
    action="{{ route("categorys.search") }}"
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
                <th>Name</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorys as $item => $result)
                <tr>
                    <td>{{ $item+$categorys->firstitem() }}</td>
                    <td>{{ $result->name }}</td>
                    <td>{{ $result->created_at->diffForHumans() }}</td>
                    <td>
                        <form action="{{ route("categorys.destroy",$result->slug) }}" method="post">
                            <a href="{{ route("categorys.edit",$result->slug) }}">
                                <button class="btn btn-warning" type="button"><i class="fas fa-pencil-alt"></i></button>
                            </a>
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categorys->links() }}
    
@endsection