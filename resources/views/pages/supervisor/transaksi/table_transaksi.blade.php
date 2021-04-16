
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Transaksi Approve</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Nama Sales</th>
                                        <th>Nama Costumer</th>
                                        <th>Jumlah Barang</th>
                                        <th>Total Harga</th>
                                        <th>Tanggal Order</th>
                                        <th>Status</th>
                                            <th>Detail</th>
                                        @if (Auth::user()->id_level == 2)
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_detail as $o)
                                    @if (isset($o->detail_order[0])  && $o->detail_order[0]->status == "1" || $o['status'] == "1")
                                        <tr>
                                            <td>
                                                {{
                                                   isset($o->sales)  ? $o->sales->nama_sales : $o['sales']
                                                }}
                                            </td>
                                            <td>{{
                                               isset($o->costumer) ? $o->costumer->nama_costumer : $o['customer']
                                            }}</td>
                                            <td>{{isset($o->detail_order) ? $o->detail_order->sum('jml_barang') : $o['total']}}</td>
                                            <td>{{isset($o->total_harga) ? number_format($o->total_harga) : $o['harga']}}</td>
                                            <td>{{date("d, F Y",strtotime(isset($o->tgl_order) ? $o->tgl_order : $o['tgl_order']))}}</td>
                                            <td>
                                                <div class="badge badge-success">
                                                    Sudah Approve
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{route("detailOrder",$o['id_order'])}}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-search-plus"></i>
                                                </a>
                                            </td>
                                            @if (Auth::user()->id_level == "2")
                                                <td>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <a href="{{route("unapproveTransaksi",$o['id_order'])}}" class="btn btn-primary btn-sm"><i class="fa fa-times"></i></a>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="{{route("deleteTransaksi",$o['id_order'])}}" class="btn btn-sm btn-danger">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nama Sales</th>
                                        <th>Nama Costumer</th>
                                        <th>Jumlah Barang</th>
                                        <th>Total Harga</th>
                                        <th>Tanggal Order</th>
                                        <th>Status</th>
                                        <th>Detail</th>
                                        @if (Auth::user()->id_level == 2)
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Transaksi Belum Approve</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Nama Sales</th>
                                        <th>Nama Costumer</th>
                                        <th>Jumlah Barang</th>
                                        <th>Total Harga</th>
                                        <th>Tanggal Order</th>
                                        <th>Status</th>
                                            <th>Detail</th>
                                        @if (Auth::user()->id_level == 2)
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_detail as $o)
                                    @if (isset($o->detail_order[0]) && $o->detail_order[0]->status == "0" || $o['status'] == "0")
                                        <tr>
                                            <td>
                                                {{
                                                   isset($o->sales)  ? $o->sales->nama_sales : $o['sales']
                                                }}
                                            </td>
                                            <td>{{
                                               isset($o->costumer) ? $o->costumer->nama_costumer : $o['customer']
                                            }}</td>
                                            <td>{{isset($o->detail_order) ? $o->detail_order->sum('jml_barang') : $o['total']}}</td>
                                            <td>{{isset($o->total_harga) ? number_format($o->total_harga) : $o['harga']}}</td>
                                            <td>{{date("d, F Y",strtotime(isset($o->tgl_order) ? $o->tgl_order : $o['tgl_order']))}}</td>
                                            <td>
                                                <div class="badge badge-danger">
                                                    Belum Approve
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{route("detailOrder",$o['id_order'])}}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-search-plus"></i>
                                                </a>
                                            </td>
                                            @if (Auth::user()->id_level == "2")
                                                <td>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <a href="{{route("approveTransaksi",$o['id_order'])}}" class="btn btn-primary btn-sm"><i class="fa fa-check"></i></a>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="{{route("deleteTransaksi",$o['id_order'])}}" class="btn btn-sm btn-danger">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nama Sales</th>
                                        <th>Nama Costumer</th>
                                        <th>Jumlah Barang</th>
                                        <th>Total Harga</th>
                                        <th>Tanggal Order</th>
                                        <th>Status</th>
                                        <th>Detail</th>
                                        @if (Auth::user()->id_level == 2)
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
