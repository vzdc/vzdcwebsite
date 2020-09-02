@extends('layouts.email')

@section('content')
    <p><b>Name:</b> {{ $loa->controller_name }}</p>
    <p>Your LOA has expired due to activity within vZDC.</p>
    <p>You will now be responsible to for your activity. If you require further time on LOA, please submit a new request.</p>
@endsection
