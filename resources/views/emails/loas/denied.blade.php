@extends('layouts.email')

@section('content')
    <p><b>Controller:</b> {{ $loa->controller_name }}</p> 
    <p><b>LOA ID:</b> {{$loa->id}}</p>
    <p><b>LOA Status:</b> Denied</p>
    <p><b>LOA Start Date:</b> {{ $loa->start_date}}</p>
    <p><b>LOA End Date:</b> {{ $loa->end_date}}</p>
    <p><b>Denial Reason:</b></p>
    <p> {{$reason}}</p>
    <br />
    <p>If you have any questions please contact datm@vzdc.org by email for further details.</p>
@endsection
