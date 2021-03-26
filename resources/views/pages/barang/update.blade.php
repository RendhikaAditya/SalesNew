@extends('welcome')

@section('content')
    <form action="{{route("updateBarang",$b)}}" method="post" enctype="multipart/form-data">
        @method("put")
        @csrf
        @include('pages.barang.form')
    </form>
@endsection
