<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <div class="navbar-brand-box">
                @role('admin')
                    <a href="{{ url('admin/dashboard') }}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/others/favicon.png') }}" alt="logo-sm-dark" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/others/logo.png') }}" alt="logo-dark" height="20">
                        </span>
                    </a>
                    <a href="{{ url('admin/dashboard') }}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/others/favicon-white.png') }}" alt="logo-sm-light" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/others/logo-white.png') }}" alt="logo-light" height="20">
                        </span>
                    </a>
                @endrole
                @role('owner')
                    <a href="{{ url('owner/dashboard') }}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/others/favicon.png') }}" alt="logo-sm-dark" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/others/logo.png') }}" alt="logo-dark" height="20">
                        </span>
                    </a>
                    <a href="{{ url('owner/dashboard') }}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/others/favicon-white.png') }}" alt="logo-sm-light" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/others/logo-white.png') }}" alt="logo-light" height="20">
                        </span>
                    </a>
                @endrole
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>

            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Cari...">
                    <span class="ri-search-line"></span>
                </div>
            </form>
        </div>
        <div class="d-flex">
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-notification-3-line"></i>
                    @foreach($notifications as $notification)
                        @if($notification->unread)
                            <span class="noti-dot"></span>
                        @endif
                    @endforeach
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0">Notifikasi</h6>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        @foreach($notifications as $notification)
                            @if($notification->unread)
                                <a href="javascript:void(0)" class="text-reset notification-item" onclick="markAsReadAndNavigate('{{ $notification->message_id }}')">
                                    <div class="d-flex">
                                        <div class="flex-1">
                                            <h6 class="mb-1">Pesanan Baru</h6>
                                            <div class="font-size-12 text-muted">
                                                <p class="mb-1">{{ ucwords($notification->first_name) }} {{ ucwords($notification->last_name) }} telah melakukan pemesanan</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('storage/profiles/'. Auth::user()->image) }}" alt="profile" class="rounded-4 header-profile-user">
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="javascript:;" class="dropdown-item">{{ Auth::user()->name }}</a>
                    <div class="dropdown-divider"></div>
                    @role('admin')
                        <a href="{{ url('admin/profile') }}" class="dropdown-item">
                            <i class="ri-user-line align-middle me-1"></i> Profil
                        </a>
                    @endrole
                    @role('owner')
                        <a href="{{ url('owner/profile') }}" class="dropdown-item">
                            <i class="ri-user-line align-middle me-1"></i> Profil
                        </a>
                    @endrole
                    <div class="dropdown-divider"></div>
                    <button class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout
                    </button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
