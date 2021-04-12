@extends('welcome')

@section('content')
    <form action="{{route("addKategori")}}" method="post" enctype="multipart/form-data">
        @csrf
        @include('pages.kategori.form')
    </form>
@endsection
