@extends('layouts.email')

@section('content')
    <p>Your LOA Has Been Denied.</p>
    <br>
    <p><b>Denial Reason</b></p>
    <p> {{$reason}}</p>
@endsection
