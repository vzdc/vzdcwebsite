@extends('layouts.email')

@section('content')
    <p><b>Name:</b> {{ $loa->controller_name }}</p>
    <p><b>LOA ID</b> {{$loa->id}}</p>
    <p><b>LOA Status</b> Ended due to controlling</p>
    <p><b>Start Date</b> {{ $loa->start_date}}</p>
    <p><b>End Date</b> {{ $loa->end_date}}</p>
    <br />
    <p>You will now be responsible to for your activity. If you require further time on LOA, please submit a new request.</p>
    <br />
    <p>If you have any questions please contact datm@vzdc.org by email for further details.</p>
@endsection
