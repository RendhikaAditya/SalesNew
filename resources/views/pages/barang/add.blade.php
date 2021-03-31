@extends('welcome')

@section('content')
    <form action="{{route("addBarang")}}" method="post" enctype="multipart/form-data">
        @csrf
        @include('pages.barang.form')
    </form>
@endsection
