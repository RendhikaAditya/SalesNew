@extends('welcome')

@section('content')
    <form action="{{route("updateSales",$s)}}" method="post">
        @csrf
        @include('pages.sales.form')
    </form>
@endsection