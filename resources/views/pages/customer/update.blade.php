@extends('welcome')

@section('content')
    <form action="{{route("updateCostumer",$c)}}" method="post">
        @csrf
        @method('put')
        @include('pages.customer.form')
    </form>
@endsection
