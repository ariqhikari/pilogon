 {{-- awal navbar --}}
        <nav class="nav align-items-center justify-content-between">
            <div style="float: left">
                <a href="{{ route('LandingPage.index') }}">
                    @yield('logo')
                </a>
            </div>
            <div style="float: right;z-index:99">
                <div id="mySidenav" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn sidenav-link" onclick="closeNav()">&times;</a>
                    <a href="{{ url("/") }}" class="sidenav-link {{ (request()->is('/')) ? 'active' : '' }}"><i class="fas fa-home"></i> Home</a>
                    <a href="{{ route("blogs.index") }}" class="sidenav-link {{ (request()->is('blogs*')) ? 'active' : '' }}"><i class="fab fa-blogger-b"></i> Blog</a>
                    <a href="{{ route("class.index") }}" class="sidenav-link {{ (request()->is('class*')) ? 'active' : '' }}"><i class="fas fa-swatchbook"></i> Kelas</a>
                    <a href="{{ route("forum.index") }}" class="sidenav-link {{ (request()->is('forum*')) ? 'active' : '' }}"><i class="fas fa-users"></i> Forum</a>
                    @if(Auth::user() == true)
                        @if (Auth::user()->permission == "admin")
                            <a href="{{ route("admin.dashboard") }}" class="sidenav-link"><i class="fas fa-lock"></i>  Dashboard</a>
                        @endif
                    @endif
                    @if (Auth::user() == false)
                        <a href="{{ route("login") }}" class="sidenav-link">
                            <button class="btn-login">Login</button>
                        </a>
                        <a href="{{ route("register") }}" class="sidenav-link">
                            <button class="btn-registrasi">Register</button>
                        </a>
                    @else
                        <div class="d-flex align-items-center mt-3 d-md-none sidenav-link" id="img-mobile-profile" style="cursor: pointer;">
                            <div class="mr-2">
                                <img  src="{{ Storage::url(Auth::user()->foto) }}" width="35px" height="35px" class="rounded-circle" alt="" style="margin-left: -7px;">
                            </div>
                            <span style="font-size:18px" class="user-sidebar">
                                <span>{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down" style="margin-left: 5px;font-size: 12px;"></i>
                            </span>
                        </div>
                        <div class="shadow d-md-none mx-auto mt-3" id="box-mobile-profile" style="display: none;border-radius:10px;width:200px;min-height:220px">
                            <br>
                            <a href="{{ route("user.show",Auth::user()->slug) }}" class="sidenav-link" style="font-size:16px;margin-left:-9px" class="px-auto">
                                <i class="fas fa-user" style="color: #59E0C0"></i> Profile Saya
                            </a>
                            <hr>
                            <a href="{{ route("user.edit",Auth::user()->slug) }}" class="sidenav-link" style="font-size:16px;margin-left:-9px" class="px-auto">
                                <i class="fas fa-user-edit" style="color: #59E0C0"></i> Edit Profile
                            </a>
                            <hr>
                            <form class="sidenav-link" id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="sidenav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" style="font-size:16px;margin-left:-9px" class="px-auto">
                                <i class="fas fa-sign-out-alt" style="color: #59E0C0"></i> Logout
                            </a>
                        </div>
                    @endif
                </div>
                
                @if (Auth::user() == true)
                    <div class="d-none d-md-inline" id="img-profile" style="cursor: pointer">
                        <i class="fas fa-chevron-down" id="logo-down"></i>
                        <img  src="{{ Storage::url(Auth::user()->foto) }}" width="35px" height="35px" class="rounded-circle" alt="" style="margin-right: 25px;margin-top:-16px;">
                    </div>
                    <div class="shadow" style="display:none;width: 150px;height:180px;background-color:#f7f7f7;position:absolute;margin-left:-150px;z-index:100;margin-top:10px;border-radius:10px;text-align:center" id="box-profile">
                        <br>
                        <a href="{{ route("user.show",Auth::user()->slug) }}" style="color: #4d4d4d">
                            <i class="fas fa-user" style="color: #59E0C0"></i> Profile Saya
                        </a>
                        <hr>
                        <a href="{{ route("user.edit",Auth::user()->slug) }}" style="color: #4d4d4d">
                            <i class="fas fa-user-edit" style="color: #59E0C0"></i> Edit Profile
                        </a>
                        <hr>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt" style="color: #59E0C0"></i> Logout
                        </a>
                    </div>
                @endif
        
                <!-- Use any element to open the sidenav -->
                <span onclick="openNav()" ><i class="fas fa-align-right" id="logo-nav"></i></span>
                
                <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
                <div id="main">
                </div>
            </div>
        </nav>
{{-- akhir navbar --}}