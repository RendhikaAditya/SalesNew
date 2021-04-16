<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
    <li class="nav-item {{request()->is("supervisor") || request()->is("supervisor/transaksi*") || request()->is('detail-transaksi*')? 'active' : ''}}"><a href="#"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Ecommerce">Data Transaksi</span></a>
        <ul class="menu-content">
            <li><a href="{{route("supervisorIndex")}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">Data Transaksi</span></a>
            </li>
        </ul>
    </li>
</ul>
