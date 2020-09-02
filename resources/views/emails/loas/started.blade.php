@extends('layouts.email')

@section('content')
    <p><b>Name:</b> {{ $loa->controller_name }}</p>
    <p><b>LOA ID</b> {{$loa->id}}</p>
    <p><b>LOA Status</b> Started</p>
    <p><b>Start Date</b> {{ $loa->start_date}}</p>
    <p><b>End Date</b> {{ $loa->end_date}}</p>
    <br />
    <p>Keep in mind, if you do control a ZDC facility during your LOA, you will automatically be reverted back to active status.</p>
    <br />
    <p>If you have any questions please contact datm@vzdc.org by email for further details.</p>
@endsection
