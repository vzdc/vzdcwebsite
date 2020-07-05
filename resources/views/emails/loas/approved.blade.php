@extends('layouts.email')

@section('content')
    <p>Your LOA Has Been Approved.</p>
    <br>
    <p><b>End Date</b> {{ $loa->end_date}}</p>
    <p>Keep in mind, if you do control a ZDC facility during your LOA, you will automatically be reverted back to active status.</p>
@endsection
