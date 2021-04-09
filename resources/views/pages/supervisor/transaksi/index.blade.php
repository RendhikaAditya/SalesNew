@extends('welcome')

@section('content')
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Filter Data Transaksi</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <form action="{{route("filter_transaksi")}}">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Nama Costumer</label>
                                        <input type="text" name="costumer" class="form-control" placeholder="Nama Costumer">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Nama Sales</label>
                                        <input type="text" name="sales" class="form-control" placeholder="Nama Sales">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Tanggal Awal</label>
                                        <input type="date" name="tgl_awal" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Tanggal Akhir</label>
                                        <input type="date" name="tgl_akhir" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-filter"></i> Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Transaksi</h4>
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
                                        @if (Auth::user()->id_level == 2)
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_detail as $o)
                                        <tr>
                                            <td>{{$o['sales']}}</td>
                                            <td>{{$o['customer']}}</td>
                                            <td>{{$o['total']}}</td>
                                            <td>{{"Rp.".number_format($o['harga'])}}</td>
                                            <td>{{date("m, F Y",strtotime($o['tgl_order']))}}</td>
                                            <td>
                                                <div class="{{
                                                    $o['status'] == "0" ? "badge badge-danger" : "badge badge-success"
                                                }}">
                                                    {{
                                                        $o['status'] == "0"
                                                        ? "Belum Approve"
                                                        : "Sudah Approve"
                                                    }}
                                                </div>
                                            </td>
                                            @if (Auth::user()->id_level == "2")
                                                <td>
                                                    {{-- {{dd($o)}} --}}
                                                    @if ($o['status'] == "0")
                                                        <a href="{{route("approveTransaksi",$o['id_order'])}}" class="w-100 btn btn-primary btn-sm">Approve</a>
                                                    @else
                                                        <a href="{{route("unapproveTransaksi",$o['id_order'])}}" class="w-100 btn btn-primary btn-sm">Unapprove</a>
                                                    @endif
                                                    {{-- <a href="" class="btn btn-primary btn-sm">Tidak Approve</a> --}}
                                                </td>
                                            @endif
                                        </tr>
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
</section>

@push('table-css')
    <link rel="stylesheet" type="text/css" href="/assets/vendors/css/tables/datatable/datatables.min.css">
@endpush
@push('table-vendor')
    <script src="/assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="/assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="/assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="/assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="/assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="/assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="/assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="/assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
@endpush
@push('table-init-js')
  <script src="/assets/js/scripts/datatables/datatable.js"></script>
@endpush

@endsection
