<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
        <img src="https://media.cakeresume.com/image/upload/s--2ClbV2Si--/c_pad,fl_png8,h_315,w_600/v1669277480/yqwll5dgwicv4ejpdlay.png" alt=""
            class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-light"> CANDARIA </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://cdn-icons-png.flaticon.com/512/3177/3177440.png" class="img-circle elevation-2" alt="">
            </div>
            <div class="info">
                <h5 style="color: white"  class="d-block">{{ Auth::user()->name }}</h5>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if (Auth::user()->role == 1)
                    <li class="nav-item">
                        <a href="{{ URL::to('/home') }}" class="nav-link {{ activeSegment('home', 1) }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-header">Manajemen</li>
                    <li class="nav-item">
                        <a href="{{ URL::to('/user_list') }}" class="nav-link {{ activeSegment('user_list', 1) }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                List Akun
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link {{ activeSegment('products', 1) }}">
                            <i class="nav-icon fas fa-th-large"></i>
                            <p>
                                Produk
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Transaksi</li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('cart.index') }}" class="nav-link {{ activeSegment('cart', 1) }}">
                            <i class="nav-icon fas fa-barcode"></i>
                            <p>Transaksi Baru</p>
                        </a>
                    </li>
                    <li class="nav-header">Laporan</li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('orders.index') }}" class="nav-link {{ activeSegment('orders', 1) }}">
                            <i class="nav-icon fas fa-cart-plus"></i>
                            <p>Riwayat</p>
                        </a>
                    </li>
                    <li class="nav-header">Lainnya</li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('changelogs.index') }}" class="nav-link {{ activeSegment('changelogs', 1) }}">
                            <i class="nav-icon far fa-plus-square"></i>
                            <p>Perubahan</p>
                        </a>
                    </li> --}}

                    <li class="nav-item has-treeview">
                        <a href="{{ route('settings.index') }}" class="nav-link {{ activeSegment('settings', 1) }}">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>Pengaturan</p>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role == 2)
                    <li class="nav-item">
                        <a href="{{ URL::to('/home') }}" class="nav-link {{ activeSegment('home', 1) }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-header">Manajemen</li>
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link {{ activeSegment('products', 1) }}">
                            <i class="nav-icon fas fa-th-large"></i>
                            <p>
                                Produk
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Transaksi</li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('cart.index') }}" class="nav-link {{ activeSegment('cart', 1) }}">
                            <i class="nav-icon fas fa-barcode"></i>
                            <p>Transaksi Baru</p>
                        </a>
                    </li>
                    <li class="nav-header">Laporan</li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('orders.index') }}" class="nav-link {{ activeSegment('orders', 1) }}">
                            <i class="nav-icon fas fa-cart-plus"></i>
                            <p>Riwayat</p>
                        </a>
                    <li class="nav-header">Lainnya</li>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('changelogs.index') }}" class="nav-link {{ activeSegment('changelogs', 1) }}">
                            <i class="nav-icon far fa-plus-square"></i>
                            <p>Perubahan</p>
                        </a>
                    </li> --}}

                    <li class="nav-item has-treeview">
                        <a href="{{ route('settings.index') }}" class="nav-link {{ activeSegment('settings', 1) }}">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>Pengaturan</p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="document.getElementById('logout-form').submit()">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Keluar</p>
                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                            @csrf
                        </form>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
