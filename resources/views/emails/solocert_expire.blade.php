@extends('layouts.email')

@section('content')
    <p>Dear {{ $user->full_name }},</p>

    <p>Your solo certification has expired.</p>

    <p>If you believe there are any errors, please contact the training administrator at <a href="mailto:ta@vzdc.org">ta@vzdc.org</a>.
    </p>

    <p>Best regards,</p>
    <p>ZDC Training Staff</p>
@endsection
