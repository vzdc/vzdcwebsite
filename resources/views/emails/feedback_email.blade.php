@extends('layouts.email')

@section('content')
    {!! nl2br($body) !!}
@endsection

@section('footer')
    <p><b>Automated from vZDC ARTCC issued on the behalf of {{ $sender->full_name }}.</b></p>
    <b>Please note this is a <u>NON-MONITORED</u> email box, if you have additional concerns / questions please email TA@vzdc.org.</b>
@endsection
