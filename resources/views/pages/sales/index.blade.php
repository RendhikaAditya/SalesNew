@extends('welcome')

@section('content')

<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Sales</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Nama Sales</th>
                                        <th>Alamat Sales</th>
                                        <th>Umur Sales</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $s)
                                        <tr>
                                            <td>{{$s->username}}</td>
                                            <td>{{$s->nama_sales}}</td>
                                            <td>{{$s->alamat_sales}}</td>
                                            <td>{{$s->umur_sales}}</td>
                                            <td>{{$s->gender_sales}}</td>
                                            <td>
                                                <a href="{{route("updateSales",$s)}}" class="w-100 btn btn-primary btn-sm">Update</a>
                                                <form class="mt-1" action="{{route("deleteSales",$s)}}" method="post">
                                                    @csrf
                                                    @method("delete")
                                                    <button
                                                    onclick="return confirm('Yakin Akan Menghapus Data Ini ? ')"
                                                    type="submit" class="w-100 btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Username</th>
                                        <th>Nama Sales</th>
                                        <th>Alamat Sales</th>
                                        <th>Umur Sales</th>
                                        <th>Jenis Kelamin</th>
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

@endsection
