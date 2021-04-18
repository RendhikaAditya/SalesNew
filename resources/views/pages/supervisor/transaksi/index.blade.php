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
                                        <select class="form-control js-example-basic-single" name="costumer">
                                            <option value="{{null}}" selected>Cari Costumer</option>
                                            @foreach ($costumer as $c)
                                                <option
                                                {{
                                                    request()->get("costumer") !== null && request()->get('costumer') === $c->nama_costumer ? "selected" : ""
                                                }}
                                                value="{{$c->nama_costumer}}">{{$c->nama_costumer}}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" name="costumer" class="form-control" placeholder="Nama Costumer"> --}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Nama Sales</label>
                                        <select class="form-control js-example-basic-single" name="sales">
                                            <option value="{{null}}" selected>Cari Sales</option>
                                            @foreach ($sales as $s)
                                                <option
                                                {{
                                                    request()->get("sales") !== null && request()->get('sales') === $s->nama_sales ? "selected" : ""
                                                }}
                                                value="{{$s->nama_sales}}">{{$s->nama_sales}}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" name="sales" class="form-control" placeholder="Nama Sales"> --}}
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
                                <a href="{{route('generateLaporan')}}" class="btn btn-sm btn-success">
                                    Export Laporan Excel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.supervisor.transaksi.table_transaksi')
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
