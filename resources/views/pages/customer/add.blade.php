@extends('welcome')

@section('content')
    <form action="{{route('addCustomer')}}" method="post">
        @csrf
        @include("pages.customer.form")
    </form>
@endsection
