<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

    <li class=" nav-item {{request()->is("admin/transaksi*") || request()->is("admin") || request()->is("detail-transaksi*") ? "active" : ""}}"><a href="#"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Ecommerce">Dashboard</span></a>
        <ul class="menu-content">
            <li><a href="{{route("adminIndex")}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Data Transaksi</span></a>
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
    <li class=" nav-item {{request()->is("admin/user*") ? "active" : ""}}"><a href="#"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Ecommerce">Data User</span></a>
        <ul class="menu-content">
            <li><a href="{{route("listUsers")}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">User</span></a>
            </li>
            <li><a href="{{route("addUser")}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Tambah Data</span></a>
            </li>
        </ul>
    </li>
    <li class="nav-item {{request()->is("admin/customer*") ? "active" : ""}}"><a href="#"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Ecommerce">Data Costumer</span></a>
        <ul class="menu-content">
            <li><a href="{{route("listCustomer")}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Costumer</span></a>
            </li>
            <li><a href="{{route("addCustomer")}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Tambah Costumer</span></a>
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
    <li class=" nav-item {{request()->is("admin/bentuk-pembayaran*") ? "active" : ""}}"><a href="#"><i class="feather icon-list"></i><span class="menu-title" data-i18n="Ecommerce">Data Bentuk Pembayaran</span></a>
        <ul class="menu-content">
            <li>
                <a href="{{route("listBentukPembayaran")}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Data Bentuk Pembayaran</span></a>
            </li>
            <li>
                <a href="{{route("addPembayaran")}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Tambah Bentuk Pembayaran</span></a>
            </li>
        </ul>
    </li>
</ul>
