@extends('welcome')

@section('content')
    <form action="{{route("addPembayaran")}}" method="post">
        @csrf
        @include('pages.pembayaran.form')
    </form>
@endsection
