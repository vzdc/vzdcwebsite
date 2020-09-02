@extends('layouts.email')

@section('content')
    <p>Your LOA has been approved.</p>
    <p><b>Name:</b> {{ $loa->controller_name }}</p>
    <p><b>Start Date:</b> {{ $loa->start_date}}</p>
    <p><b>End Date:</b> {{ $loa->end_date}}</p>
    <br />
    <p>Keep in mind, if you do control a ZDC facility during your LOA, you will automatically be reverted back to active status.</p>
@endsection
