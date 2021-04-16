@extends('welcome')

@section('content')
    <form action="{{route("updateSales",$data)}}" method="post">
        @csrf
        @method('put')
        @include('pages.sales.form')
    </form>
@endsection
