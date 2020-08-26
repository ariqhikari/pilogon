<div class="main-sidebar">
    <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ url("/") }}">
            <h6 class="mt-4">Pilogon</h6>
        </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('LandingPage.index') }}">PG</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li>
            <a href="{{route("dashboard")}}"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
        </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i> <span>Users</span></a>
                <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route("admin.userIndex") }}">List Users</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-tags"></i> <span>Categorys</span></a>
                <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route("categorys.index") }}">List Categorys</a></li>
                <li><a class="nav-link" href="{{ route("categorys.create") }}">Create Categorys</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-book"></i> <span>Courses</span></a>
                <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route("admin.coursesIndex") }}">List Courses</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Forums</span></a>
                <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route("admin.forumIndex") }}">List Forums</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fab fa-blogger-b"></i> <span>Blogs</span></a>
                <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route("admin.blogIndex") }}">List Blogs</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('LandingPage.index') }}" class="nav-link"><i class="fas fa-home"></i> <span>Home</span></a>
            </li>
        </ul>
    </aside>
</div>