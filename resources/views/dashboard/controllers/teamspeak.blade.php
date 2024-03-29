@extends('layouts.dashboard')

@section('title')
    Teamspeak Info
@endsection

@section('content')
    <div class="container-fluid" style="background-color:#F0F0F0;">
        &nbsp;
        <h2>ZDC ARTCC Teamspeak Information</h2>
        &nbsp;
    </div>
    <br>

    <div class="container">
        <center><h1>vZDC ARTCC Teamspeak Information</h1></center>
        <hr>
        <center><h3>Teamspeak is used for all training and all controller communications, but all members are welcome to
                join us in the teamspeak. You can connect to the teamspeak server, without a password, using the
                IP:</h3></center>
        <center><h2><a href="ts3server://ts.vzdc.org?port=9987">ts.vzdc.org</a></h2></center>
        <hr>
        <center><h2>Teamspeak Rules:</h2></center>
        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
                <ul>
                    <li>All users must join TeamSpeak using the name associated with their VATSIM account.</li>
                    <li>Anonymous users will be kicked with a warning and banned upon reconnecting anonymously.</li>
                    <li>Teamspeak permissions are required to move within Teamspeak. Please contact a staff member
                        to receive appropriate permissions. (If you are not a member of the VATUSA region, please provide
                        your CID for rating verification).
                    </li>
                    <li>Streaming while controlling is allowed and encouraged although the audio from Teamspeak is
                        not allowed for the privacy of other controllers. Streaming Teamspeak audio requires the written
                        permission of the ATM (Contact the ATM at <a href="atm@vzdc.org">atm@vzdc.org</a> for
                        permission). Streaming audio without his/her permission may result in the loss of Teamspeak
                        privileges.
                    </li>
                    <li>Controlling rooms are limited to controlling only. If a controller asks for you to leave, please
                        do so.
                    </li>
                    <li>Use of Teamspeak is a privilege and can be revoked by a staff member at any time and for any
                        reason. To appeal teamspeak bans, please contact the DATM at <a href="datm@vzdc.org">datm@vzdc.org</a>.
                    </li>
                </ul>
            </div>
            <div class="col-sm-2">
            </div>
        </div>
        <hr>
        <center><p>If you have any additional questions, please contact either the ATM or DATM at <a
                        href="atm@vzdc.org">atm@vzdc.org</a> or <a href="datm@vzdc.org">datm@vzdc.org</a> respectively.
            </p></center>
    </div>

@endsection
