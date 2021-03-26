@extends('welcome')

@section('content')
    <form action="{{route("addSales")}}" method="post">
        @csrf
        @include('pages.sales.form')
    </form>
@endsection