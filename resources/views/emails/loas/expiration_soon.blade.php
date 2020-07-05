@extends('layouts.email')

@section('content')
    <p>Your LOA is Expiring Soon</p>
    <br>
    <p><b>End Date</b> {{ $loa->end_date}}</p>
    <p>Once your LOA expires keep in mind you will be responsible to remain active within the ARTCC.</p>
@endsection
