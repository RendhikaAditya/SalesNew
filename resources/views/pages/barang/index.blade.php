@extends('welcome')

@section('content')

<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Barang</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Harga Barang</th>
                                        <th>Kategori Barang</th>
                                        <th>Katerangan</th>
                                        <th>Foto Barang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barang as $b)
                                        <tr>
                                            <td>{{$b->nama_barang}}</td>
                                            <td>{{number_format($b->harga_barang)}}</td>
                                            <td>
                                                {{isset($b->kategori) ? $b->kategori->nama_kategori : "Tidak Ada Kategori"}}
                                            </td>
                                            <td>
                                                {!!
                                                    $b->keterangan !== null ? $b->keterangan : "Tidak Ada Ketarangan"
                                                !!}
                                            </td>
                                            <td>
                                                @if ($b->foto_barang === "Tidak Ada Foto" || $b->foto_barang === "null")
                                                    {{$b->foto_barang}}
                                                @else
                                                    <img class="w-50" src="/assets/images/{{$b->foto_barang}}" alt="Barang">
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route("updateBarang",$b)}}" class="w-100 btn btn-primary btn-sm">Update</a>
                                                <form class="mt-1" action="{{route("deleteBarang",$b)}}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button
                                                    onclick="return confirm('Yakin Akan Menghapus Data Ini ?')"
                                                    class="w-100 btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Harga Barang</th>
                                        <th>Kategori Barang</th>
                                        <th>Katerangan</th>
                                        <th>Foto Barang</th>
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
