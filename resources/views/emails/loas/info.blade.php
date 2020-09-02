@extends('layouts.email')

@section('content')
    <p>More information is required for your LOA request:</p>
    <p>{{ $info }}</p>
    <br>
    <p>Please email datm@vzdc.org with the required information.</p>
@endsection
