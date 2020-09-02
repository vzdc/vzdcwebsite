@extends('layouts.email')

@section('content')
    <p><b>Name:</b> {{ $loa->controller_name }}</p>
    <p>Your LOA has been denied.</p>
    <p><b>Denial Reason:</b></p>
    <p> {{$reason}}</p>
@endsection
