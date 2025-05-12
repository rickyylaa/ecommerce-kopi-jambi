<header id="header" class="header header-sticky header-sticky-smart disable-transition-all z-index-5">
    <div class="sticky-area">
        <div class="main-header nav navbar bg-body navbar-light navbar-expand-xl py-6 py-xl-0">
            <div class="container-xxl container">
                <div class="d-flex d-xl-none w-100">
                    <div class="w-72px d-flex d-xl-none">
                        <button class="navbar-toggler align-self-center border-0 shadow-none px-0 canvas-toggle p-4" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvasNavBar" aria-controls="offCanvasNavBar" aria-expanded="false" aria-label="Toggle Navigation">
                            <span class="fs-24 toggle-icon"></span>
                        </button>
                    </div>
                    <div class="d-flex mx-auto">
                        <a href="{{ route('front.index') }}" class="navbar-brand px-8 py-4 mx-auto">
                            <img src="{{ asset('assets/images/others/logo.png') }}" class="light-mode-img" alt="logo" width="179" height="26">
                            <img src="{{ asset('assets/images/others/logo-white.png') }}" class="dark-mode-img" alt="logo" width="179" height="26">
                        </a>
                    </div>
                    <div class="icons-actions d-flex justify-content-end w-xl-50 fs-28px text-body-emphasis">
                        <div class="px-5 d-xl-inline-block">
                            <a class="position-relative lh-1 color-inherit text-decoration-none" href="#" data-bs-toggle="offcanvas" data-bs-target="#shoppingCart" aria-controls="shoppingCart" aria-expanded="false">
                                <svg class="icon icon-star-light">
                                    <use xlink:href="#icon-shopping-bag-open-light"></use>
                                </svg>
                                @if ($cart_total > 0)
                                    <span class="badge bg-dark text-white position-absolute top-0 start-100 translate-middle mt-4 rounded-circle fs-13px p-0 square" style="--square-size: 18px">{{ $cart_total }}</span>
                                @endif
                            </a>
                        </div>
                        @if (auth()->guard('customer')->check())
                            <div class="color-modes position-relative ps-5">
                                <a class="lh-1 color-inherit text-decoration-none" href="#" aria-expanded="true" data-bs-toggle="dropdown" data-bs-display="static" aria-label="Toggle theme (light)">
                                    <svg class="icon icon-user-light">
                                        <use xlink:href="#icon-user-light"></use>
                                    </svg>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end fs-14px" data-bs-popper="static">
                                    <li>
                                        <a href="{{ route('customer.account') }}" class="dropdown-item d-flex align-items-center @yield('active-account')" aria-pressed="@yield('true-account')">
                                            <svg class="bi me-4 opacity-50 theme-icon">
                                                <use href="#user-fill"></use>
                                            </svg> Account
                                            <svg class="bi ms-auto d-none">
                                                <use href="#check2"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('customer.orders') }}" class="dropdown-item d-flex align-items-center @yield('active-order')" aria-pressed="@yield('true-account')">
                                            <svg class="bi me-4 opacity-50 theme-icon">
                                                <use href="#shopping-cart-fill"></use>
                                            </svg> Pesanan Saya
                                            <svg class="bi ms-auto d-none">
                                                <use href="#check2"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('customer.logout') }}" class="dropdown-item d-flex align-items-center" aria-pressed="false">
                                            <svg class="bi me-4 opacity-50 theme-icon">
                                                <use href="#out-fill"></use>
                                            </svg> Logout
                                            <svg class="bi ms-auto d-none">
                                                <use href="#check2"></use>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <div class="d-xl-inline-block">
                                <a class="lh-1 color-inherit text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#signInModal">
                                    <svg class="icon icon-user-light">
                                        <use xlink:href="#icon-user-light"></use>
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="d-none d-xl-flex flex-column flex-xl-row w-100">
                    <div class="w-auto w-xl-50 d-flex align-items-center">
                        <div class="icons-actions d-none d-xl-flex justify-content-start me-auto fs-28px text-body-emphasis">
                            <div class="pe-6">
                                <a href="#" class="lh-1 color-inherit text-decoration-none" data-bs-toggle="offcanvas" data-bs-target="#searchModal" aria-controls="searchModal" aria-expanded="false">
                                    <svg class="icon icon-magnifying-glass-light fs-5">
                                        <use xlink:href="#icon-magnifying-glass-light"></use>
                                    </svg>
                                    <span class="fs-15px"></span>
                                </a>
                            </div>
                        </div>
                        <ul class="navbar-nav w-100 w-xl-auto">
                            <li class="nav-item transition-all-xl-1 py-xl-11 py-0 px-xxl-8 px-xl-6 dropdown dropdown-hover dropdown-fullwidth">
                                <a href="{{ route('front.index') }}" class="nav-link d-flex justify-content-between position-relative py-xl-0 px-xl-0 text-uppercase fw-semibold ls-1 fs-15px fs-xl-14px">
                                    Beranda
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="px-10 d-none d-xl-flex align-items-center ">
                        <a href="{{ route('front.index') }}" class="navbar-brand px-8 py-4 mx-auto">
                            <img src="{{ asset('assets/images/others/logo.png') }}" class="light-mode-img" alt="logo" width="179" height="26">
                            <img src="{{ asset('assets/images/others/logo-white.png') }}" class="dark-mode-img" alt="logo" width="179" height="26">
                        </a>
                    </div>
                    <div class="w-auto w-xl-50 d-flex align-items-center">
                        <ul class="navbar-nav w-100 w-xl-auto">
                            <li class="nav-item transition-all-xl-1 py-xl-11 py-0 me-xxl-12 me-xl-10 dropdown dropdown-hover">
                                <a class="nav-link d-flex justify-content-between position-relative py-xl-0 px-xl-0 text-uppercase fw-semibold ls-1 fs-15px fs-xl-14px dropdown-toggle" href="#" data-bs-toggle="dropdown" id="menu-item-pages" aria-haspopup="true" aria-expanded="false">
                                    Produk
                                </a>
                                <ul class="dropdown-menu py-6" aria-labelledby="menu-item-pages">
                                    <li class="dropend dropdown-hover" aria-haspopup="true" aria-expanded="false">
                                        <a class="dropdown-item pe-6 dropdown-toggle d-flex justify-content-between border-hover" href="#" data-bs-toggle="dropdown" id="menu-item-category">
                                            <span class="border-hover-target">
                                                Kategori
                                            </span>
                                        </a>
                                        <ul class="dropdown-menu py-6" aria-labelledby="menu-item-category" data-bs-popper="none">
                                            @php
                                                $category = DB::table('categories')->orderBy('title', 'ASC')->where('status', '1')->limit(10)->get();
                                            @endphp
                                            @foreach($category as $row)
                                                <li>
                                                    <a href="{{ route('front.category', $row->slug) }}" class="dropdown-item border-hover">
                                                        <span class="border-hover-target">{{ $row->title }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="dropend dropdown-hover" aria-haspopup="true" aria-expanded="false">
                                        <a class="dropdown-item pe-6 dropdown-toggle d-flex justify-content-between border-hover" href="#" data-bs-toggle="dropdown" id="menu-item-brand">
                                            <span class="border-hover-target">
                                                Merek
                                            </span>
                                        </a>
                                        <ul class="dropdown-menu py-6" aria-labelledby="menu-item-brand" data-bs-popper="none">
                                            @php
                                                $brand = DB::table('brands')->orderBy('title', 'ASC')->where('status', '1')->limit(10)->get();
                                            @endphp
                                            @foreach($brand as $row)
                                                <li>
                                                    <a href="{{ route('front.brand', $row->slug) }}" class="dropdown-item border-hover">
                                                        <span class="border-hover-target">{{ $row->title }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="dropend dropdown-hover" aria-haspopup="true" aria-expanded="false">
                                        <a class="dropdown-item pe-6 dropdown-toggle d-flex justify-content-between border-hover" href="#" data-bs-toggle="dropdown" id="menu-item-brand">
                                            <span class="border-hover-target">
                                                Ukuran
                                            </span>
                                        </a>
                                        <ul class="dropdown-menu py-6" aria-labelledby="menu-item-brand" data-bs-popper="none">
                                            @php
                                                $size = DB::table('sizes')->orderBy('title', 'ASC')->where('status', '1')->limit(10)->get();
                                            @endphp
                                            @foreach($size as $row)
                                                <li>
                                                    <a href="{{ route('front.size', $row->slug) }}" class="dropdown-item border-hover">
                                                        <span class="border-hover-target">{{ $row->title }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="icons-actions d-none d-xl-flex justify-content-end ms-auto fs-28px text-body-emphasis">
                            <div class="px-5 d-none d-xl-inline-block">
                                <a class="position-relative lh-1 color-inherit text-decoration-none" href="#" data-bs-toggle="offcanvas" data-bs-target="#shoppingCart" aria-controls="shoppingCart" aria-expanded="false">
                                    <svg class="icon icon-star-light">
                                        <use xlink:href="#icon-shopping-bag-open-light"></use>
                                    </svg>
                                    @if ($cart_total > 0)
                                        <span class="badge bg-dark text-white position-absolute top-0 start-100 translate-middle mt-4 rounded-circle fs-13px p-0 square" style="--square-size: 18px">{{ $cart_total }}</span>
                                    @endif
                                </a>
                            </div>
                            @if (auth()->guard('customer')->check())
                                <div class="color-modes position-relative ps-5">
                                    <a class="lh-1 color-inherit text-decoration-none" href="#" aria-expanded="true" data-bs-toggle="dropdown" data-bs-display="static" aria-label="Toggle theme (light)">
                                        <svg class="icon icon-user-light">
                                            <use xlink:href="#icon-user-light"></use>
                                        </svg>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end fs-14px" data-bs-popper="static">
                                        <li>
                                            <a href="{{ route('customer.account') }}" class="dropdown-item d-flex align-items-center @yield('active-account')" aria-pressed="@yield('true-account')">
                                                <svg class="bi me-4 opacity-50 theme-icon">
                                                    <use href="#user-fill"></use>
                                                </svg> Akun
                                                <svg class="bi ms-auto d-none">
                                                    <use href="#check2"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('customer.orders') }}" class="dropdown-item d-flex align-items-center @yield('active-order')" aria-pressed="@yield('true-account')">
                                                <svg class="bi me-4 opacity-50 theme-icon">
                                                    <use href="#shopping-cart-fill"></use>
                                                </svg> Pesanan
                                                <svg class="bi ms-auto d-none">
                                                    <use href="#check2"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('customer.logout') }}" class="dropdown-item d-flex align-items-center" aria-pressed="false">
                                                <svg class="bi me-4 opacity-50 theme-icon">
                                                    <use href="#out-fill"></use>
                                                </svg> Keluar
                                                <svg class="bi ms-auto d-none">
                                                    <use href="#check2"></use>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <div class="px-5 d-none d-xl-inline-block">
                                    <a class="lh-1 color-inherit text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#signInModal">
                                        <svg class="icon icon-user-light">
                                            <use xlink:href="#icon-user-light"></use>
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
