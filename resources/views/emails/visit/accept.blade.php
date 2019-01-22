@extends('layouts.email')
@section('content')
    <p>Dear {!! $visitor->name !!},</p>

    <p>Congratulations! You have been accepted as a visitor in Washington; pending completion of your GRP competency check.</p><br>
    <p>You can find all the information for the various facilities within the ARTCC website under the files page, <a href="http://www.vzdc.org">www.vzdc.org</a>.</p><br>
    <p>Teamspeak 3 is used for all controller communications.</p>
    <p>All visitors are required to complete a GRP competency check within 30 days of joining. This will be completed by a combined GND/TWR session at KIAD - Washington-Dulles airport. Per VATSIM and VATUSA visiting controller policies if you fail to show competency up to and including your current rating your visiting status at ZDC will be revoked and you will be referred to your home facility for remedial training. Upon completion of the GRP competency check you will be certified for minor fields up to and including your current rating. You may begin training for major airport certification at this time.</p><br>
    <p>Once again, congratulations on being accepted as a visitor in Washington ARTCC and we hope to see you on the network soon! If you have any questions, feel free to email the DATM at <a href="mailto:datm@vzdc.org">datm@vzdc.org</a>.</p><br>

    <p>Best regards,</p>
    <p>ZDC Visiting Staff</p>
@endsection
