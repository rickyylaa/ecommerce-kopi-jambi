<div data-simplebar class="h-100">
    <div id="sidebar-menu">
        @role('admin')
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Beranda</li>
                <li>
                    <a href="{{ url('admin/dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-title">Halaman</li>
                <li>
                    <a href="{{ route('category.index') }}" class="waves-effect">
                        <i class="ri-apps-line"></i>
                        <span>Kategori</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('brand.index') }}" class="waves-effect">
                        <i class="ri-apps-line"></i>
                        <span>Merek</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('size.index') }}" class="waves-effect">
                        <i class="ri-apps-line"></i>
                        <span>Ukuran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('product.index') }}" class="waves-effect">
                        <i class="ri-apps-line"></i>
                        <span>Produk</span>
                    </a>
                </li>
                <li class="menu-title">Transaksi</li>
                <li>
                    <a href="{{ route('order.index') }}" class="waves-effect">
                        <i class="ri-shopping-cart-2-line"></i>
                        <span>Pesanan</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-headphone-line"></i>
                        <span>Laporan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('admin/report/order') }}">Pesanan</a></li>
                        <li><a href="{{ url('admin/report/return') }}">Pengembalian</a></li>
                        <li><a href="{{ url('admin/report/product') }}">Produk</a></li>
                    </ul>
                </li>
                <li class="menu-title">Lainnya</li>
                <li>
                    <a href="{{ route('banner.index') }}" class="waves-effect">
                        <i class="ri-image-line"></i>
                        <span>Banner</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.index') }}" class="waves-effect">
                        <i class="ri-group-line"></i>
                        <span>Pelanggan</span>
                    </a>
                </li>
            </ul>
        @endrole
        @role('owner')
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Beranda</li>
                <li>
                    <a href="{{ url('owner/dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-title">Transaksi</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-headphone-line"></i>
                        <span>Laporan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('owner/report/order') }}">Pesanan</a></li>
                        <li><a href="{{ url('owner/report/return') }}">Pengembalian</a></li>
                        <li><a href="{{ url('owner/report/product') }}">Produk</a></li>
                    </ul>
                </li>
            </ul>
        @endrole
    </div>
</div>
