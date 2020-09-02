@extends('layouts.email')

@section('content')
    <p><b>More information is required for your LOA request:</b></p>
    <p>{{ $info }}</p>
    <br>
    <p>Please email datm@vzdc.org with the required information.</p>
@endsection
