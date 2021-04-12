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
                        <form action="{{route("detailOrder",$o)}}" method="post">
                            @csrf
                            @foreach ($detail as $d)
                                <div class="row">
                                    {{-- <input type="hidden" name="id_order" value="{{$d->id_order}}"> --}}
                                    <input type="hidden" name="id_detail_order[]" value="{{$d->id}}">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nama Barang</label>
                                            <input
                                            value="{{$d->barang->nama_barang}}"
                                            readonly type="text" class="form-control" placeholder="Nama Barang" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Jumlah Barang</label>
                                            <input
                                            value="{{$d->jml_barang}}"
                                            {{Auth::user()->id_level == "1" || $d->status == "1" ? "disabled" : ""}}
                                            type="number" name="jumlah[]" class="form-control" placeholder="Jumlah Barang" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Harga Barang</label>
                                            <input
                                            value="{{$d->harga}}"
                                            {{Auth::user()->id_level == "1"  || $d->status == "1" ? "disabled" : ""}}
                                            type="number" name="harga[]" class="form-control" placeholder="Harga Barang" required>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @if (Auth::user()->id_level == "2" && $detail[0]->status == "0")
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- @push('table-css')
    <link rel="stylesheet" type="text/css" href="/assets/vendors/css/tables/datatable/datatables.min.css">
@endpush --}}
{{-- @push('table-vendor')
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
@endpush --}}

@endsection
