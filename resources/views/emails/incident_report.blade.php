@extends('layouts.email')

@section('content')

    <p>Dear {{$user->getFullNameAttribute()}},</p>
    <br/>
    <p>
        We have received your incident report dated, {{$report->date}}. Thank you for bringing this to the attention of the senior staff. We will be in touch shortly. 
        <br/>
        {{$report->description}}
        <br/>
        Thank you,
        Raymond Salvagnini
        Air Traffic Manager
        Virtual Washington ARTCC
    </p>
@endsection