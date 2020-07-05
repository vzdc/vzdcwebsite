@extends('layouts.email')

@section('content')
    <p>Your LOA has been denied.</p>
    <p><b>Denial Reason:</b></p>
    <p> {{$reason}}</p>
@endsection
