<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
    <li class=" nav-item"><a href="index.html"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span><span class="badge badge badge-warning badge-pill float-right mr-2">2</span></a>
        <ul class="menu-content">
            <li class=""><a href="dashboard-analytics.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Analytics</span></a>
            </li>
            <li><a href="dashboard-ecommerce.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="eCommerce">eCommerce</span></a>
            </li>
        </ul>
    </li>
    <li class="nav-item"><a href="#"><i class="feather icon-list"></i><span class="menu-title" data-i18n="Ecommerce">Data Transaksi</span></a>
        <ul class="menu-content">
            <li><a href="{{route("listTransaksi")}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Data Transaksi</span></a>
            </li>
            {{-- <li><a href="{{route("addSales")}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Tambah Data</span></a>
            </li> --}}
        </ul>
    </li>
</ul>
