@extends('welcome')

@section('content')

<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Costumer</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>QR</th>
                                        <th>Nama Costumer</>
                                        <th>Alamat Costumer</th>
                                        <th>Target Harga Costumer</th>
                                        <th>Target Harga Tercapai</th>
                                        <th>Provinsi</th>
                                        <th>Kota</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($costumer as $c)
                                        <tr>
                                            <td>
                                                {{
                                                    \QrCode::size(75)->generate($c->nama_costumer)
                                                }}
                                            <a href="{{route('downloadQR',$c)}}">Download</a>
                                            </td>
                                            <td>{{$c->nama_costumer}}</td>
                                            <td>{{$c->alamat_costumer}}</td>
                                            <td>{{number_format($c->targer_harga_costumer)}}</td>
                                            <td>{{number_format($c->target_tercapai)}}</td>
                                            <td>{{$c->provinsi->provinsi}}</td>
                                            <td>{{$c->kota->kabupaten_kota}}</td>
                                            <td>
                                                <a href="{{route("updateCostumer",$c)}}" class="w-100 btn btn-primary btn-sm">Update</a>
                                                <form class="mt-1" action="{{route("deleteCostumer",$c)}}" method="post">
                                                    @csrf
                                                    @method("delete")
                                                    <button
                                                    onclick="return confirm('Yakin Akan Menghapus Data Ini ?')"
                                                    type="submit" class="btn btn-danger btn-sm w-100">
                                                    Hapus
                                                </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>QR</th>
                                        <th>Nama Costumer</>
                                        <th>Alamat Costumer</th>
                                        <th>Target Harga Costumer</th>
                                        <th>Target Harga Tercapai</th>
                                        <th>Provinsi</th>
                                        <th>Kota</th>
                                        <th>Aksi</th>
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
@php
     Storage::delete(session('img'));
@endphp
@endsection
