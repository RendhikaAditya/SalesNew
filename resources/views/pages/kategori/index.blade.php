@extends('welcome')

@section('content')

<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Kategori</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Nama Kategori</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategori as $k)
                                        <tr>
                                            <td>{{$k->nama_kategori}}</td>
                                            <td style="width:50vh;">
                                                <img class="w-50" src="/assets/images/{{$k->gambar}}" alt="Kategori">
                                            </td>
                                            <td>
                                                <a href="{{route("updateKategori",$k)}}" class="w-75 mx-auto d-block btn btn-primary btn-sm">
                                                    Update
                                                </a>
                                                <form class="mt-1" action="{{route("deleteKategori",$k)}}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button
                                                    onclick="return confirm('Yakin Akan Menghapus Data Ini ?')"
                                                    class="w-75 mx-auto d-block btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nama Kategori</th>
                                        <th>Gambar</th>
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
