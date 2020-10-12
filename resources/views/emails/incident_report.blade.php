@extends('layouts.email')

@section('content')

    <p>Dear {{$user->getFullNameAttribute()}},</p>
    <br/>
    <p>
        We have received your incident report dated, {{$report->date}}. Thank you for bringing this to the attention of the senior staff. We will be in touch shortly. 
    </p>
    <br />
    <p>
        {{$report->description}}
    </p>
    <br />
    <p>Thank you,</p>
    <p>Raymond Salvagnini</p>
    <p>Air Traffic Manager</p>
    <p>Virtual Washington ARTCC</p>
@endsection