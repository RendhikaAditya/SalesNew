@extends('welcome')

@section('content')
    <form action="{{route("updateKategori",$k)}}" method="post">
        @method("put")
        @csrf
        @include('pages.kategori.form')
    </form>
@endsection