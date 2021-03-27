@extends('welcome')

@section('content')
    <form action="{{route("updateUser",$u)}}" method="post">
        @method("put")
        @csrf
        @include('pages.user.form')
    </form>
@endsection
