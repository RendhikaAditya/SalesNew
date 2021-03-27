@extends('welcome')

@section('content')
    <form action="{{route("addUser")}}" method="post">
        @csrf
        @include('pages.user.form')
    </form>
@endsection
