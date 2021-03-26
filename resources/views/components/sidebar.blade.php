
    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="../../../html/ltr/vertical-menu-template/index.html">
                        <div class="brand-logo"></div>
                        <h2 class="brand-text mb-0">Vuexy</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a href="index.html"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span><span class="badge badge badge-warning badge-pill float-right mr-2">2</span></a>
                    <ul class="menu-content">
                        <li class=""><a href="dashboard-analytics.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Analytics</span></a>
                        </li>
                        <li><a href="dashboard-ecommerce.html"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="eCommerce">eCommerce</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item {{request()->is("admin/sales*") ? "active" : ""}}"><a href="#"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Ecommerce">Data Sales</span></a>
                    <ul class="menu-content">
                        <li><a href="{{route("listSales")}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Sales</span></a>
                        </li>
                        <li><a href="{{route("addSales")}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Tambah Data</span></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{request()->is("admin/customer*") ? "active" : ""}}"><a href="#"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Ecommerce">Data Costumer</span></a>
                    <ul class="menu-content">
                        <li><a href="{{route("listCustomer")}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Costumer</span></a>
                        </li>
                        <li><a href="{{route("addCustomer")}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Tambah Kategori</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item {{request()->is("admin/barang*") ? "active" : ""}}"><a href="#"><i class="feather icon-archive"></i><span class="menu-title" data-i18n="Ecommerce">Data Barang</span></a>
                    <ul class="menu-content">
                        <li><a href="{{route("listBarang")}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Barang</span></a>
                        </li>
                        <li><a href="{{route("addBarang")}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Tambah Barang</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item {{request()->is("admin/kategori*") ? "active" : ""}}"><a href="#"><i class="feather icon-list"></i><span class="menu-title" data-i18n="Ecommerce">Data Kategori</span></a>
                    <ul class="menu-content">
                        <li><a href="{{route("listKategori")}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Kategori</span></a>
                        </li>
                        <li><a href="{{route("addKategori")}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Tambah Kategori</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->
