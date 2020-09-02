@extends('layouts.email')

@section('content')
    <p><b>Name:</b> {{ $loa->controller_name }}</p>
    <p>Your LOA has been manually ended.</p>
    <p>Keep in mind you are now responsible for remaining active within the ARTCC. If you require further time on LOA, please submit a new request.</p>
@endsection
