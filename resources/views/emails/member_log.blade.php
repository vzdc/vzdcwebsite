@extends('layouts.email')

@section('content')

    <p>New dossier log entry added</p>

    <ul>
        <li><b>Controller:</b> {{ $controller }}</li>
        <li><b>Submitter:</b> {{ $submitter }}</li>
        <li><b>Content:</b> {{ $content }}</li>
    </ul>
@endsection
