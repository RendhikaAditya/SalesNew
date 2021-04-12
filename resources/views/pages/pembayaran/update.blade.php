@extends('welcome')

@section('content')
    <form action="{{route("updatePembayaran",$b)}}" method="post">
        @csrf
        @method('put')
        @include('pages.pembayaran.form')
    </form>
@endsection
