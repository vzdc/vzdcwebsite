@extends('layouts.email')

@section('content')
    {!! $body !!}
@endsection

@section('footer')
    <p><b>Automated from vZDC ARTCC issued on the behalf of {{ $sender->full_name }}.</b></p>
@endsection
