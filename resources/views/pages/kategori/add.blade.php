@extends('welcome')

@section('content')
    <form action="{{route("addKategori")}}" method="post">
        @csrf
        @include('pages.kategori.form')
    </form>
@endsection
