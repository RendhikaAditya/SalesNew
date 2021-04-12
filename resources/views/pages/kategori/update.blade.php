@extends('welcome')

@section('content')
    <form action="{{route("updateKategori",$k)}}" method="post" enctype="multipart/form-data">
        @method("put")
        @csrf
        @include('pages.kategori.form')
    </form>
@endsection
