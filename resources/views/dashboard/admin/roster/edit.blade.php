@extends('layouts.dashboard')

@section('title')
    Update Controller
@endsection

@section('content')
    <div class="container-fluid" style="background-color:#F0F0F0;">
        &nbsp;
        <h2>Update {{ $user->full_name }} ({{ $user->id }})</h2>
        &nbsp;
    </div>
    <br>
    <div class="container">
        {!! Form::open(['action' => ['AdminDash@updateController', $user->id]]) !!}
        @csrf
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::label('cid', 'CID') !!}
                    {!! Form::text('cid', $user->id, ['class' => 'form-control', 'disabled']) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::label('rating', 'Rating') !!}
                    {!! Form::text('rating', $user->rating_long, ['class' => 'form-control', 'disabled']) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::label('fname', 'First Name') !!}
                    {!! Form::text('fname', $user->fname, ['class' => 'form-control', 'disabled']) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::label('delgnd', 'Delivery/Ground Certification') !!}
                    {!! Form::select('delgnd', [
                        0 => 'None',
                        1 => 'Minor Certified',
                        2 => 'Major Certified'
                    ], $user->delgnd, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::label('lname', 'Last Name') !!}
                    {!! Form::text('lname', $user->lname, ['class' => 'form-control', 'disabled']) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::label('twr', 'Tower Certification') !!}
                    {!! Form::select('twr', [
                        0 => 'None',
                        99 => 'Solo Certification',
                        2 => 'Minor Certified',
                        3 => 'Major Certified'
                    ], $user->twr, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::text('email', $user->email, ['class' => 'form-control', 'disabled']) !!}
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-6">
                            {!! Form::label('app', 'Minor Approach Certification') !!}
                            {!! Form::select('app', [
                                0 => 'None',
                                99 => 'Solo Certification',
                                2 => 'Certified'
                            ], $user->app, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::label('chp', 'CHP Approach Certification') !!}
                            {!! Form::select('chp', [
                                0 => 'None',
                                99 => 'Solo Certification',
                                2 => 'Certified'
                            ], $user->chp, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::user()->can('roster'))
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::label('initials', 'Initials') !!}
                        {!! Form::text('initials', $user->initials, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6">
                                {!! Form::label('shd', 'SHD Approach Certification') !!}
                                {!! Form::select('shd', [
                                    0 => 'None',
                                    199 => 'Solo Certification',
                                    2 => 'Certified'
                                ], $user->shd, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-sm-6">
                                {!! Form::label('mtv', 'MTV Approach Certification') !!}
                                {!! Form::select('mtv', [
                                    0 => 'None',
                                    99 => 'Solo Certification',
                                    2 => 'Certified'
                                ], $user->mtv, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::label('initials', 'Initials') !!}
                        {!! Form::text('initials', $user->initials, ['class' => 'form-control', 'disabled']) !!}
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6">
                                {!! Form::label('shd', 'SHD Approach Certification') !!}
                                {!! Form::select('shd', [
                                    0 => 'None',
                                    99 => 'Solo Certification',
                                    2 => 'Certified'
                                ], $user->shd, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-sm-6">
                                {!! Form::label('mtv', 'MTV Approach Certification') !!}
                                {!! Form::select('mtv', [
                                    0 => 'None',
                                    99 => 'Solo Certification',
                                    2 => 'Certified'
                                ], $user->mtv, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if(Auth::user()->can('roster'))
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        @if($user->visitor == 1)
                            {!! Form::label('visitor_from', 'Visitor From') !!}
                            {!! Form::text('visitor_from', $user->visitor_from, ['class' => 'form-control']) !!}
                        @else
                            {!! Form::label('status', 'Status') !!}
                            {!! Form::select('status', [
                                1 => 'Active',
                                0 => 'LOA'
                            ], $user->status, ['class' => 'form-control']) !!}
                        @endif
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('ctr', 'Center Certification') !!}
                        {!! Form::select('ctr', [
                            0 => 'None',
                            99 => 'Solo Certification',
                            2 => 'Certified'
                        ], $user->ctr, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        @else
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        @if($user->visitor == 1)
                            {!! Form::label('visitor_from', 'Visitor From') !!}
                            {!! Form::text('visitor_from', $user->visitor_from, ['class' => 'form-control', 'disabled']) !!}
                        @else
                            {!! Form::label('status', 'Status') !!}
                            {!! Form::select('status', [
                                1 => 'Active',
                                0 => 'LOA'
                            ], $user->status, ['class' => 'form-control', 'disabled']) !!}
                        @endif
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('ctr', 'Center Certification') !!}
                        {!! Form::select('ctr', [
                            0 => 'None',
                            99 => 'Solo Certification',
                            2 => 'Certified'
                        ], $user->ctr, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        @endif
        @if(Auth::user()->can('roster'))
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        @if($user->visitor == 1)
                            {!! Form::label('status', 'Status') !!}
                            {!! Form::select('status', [
                                1 => 'Active',
                                0 => 'LOA'
                            ], $user->status, ['class' => 'form-control']) !!}
                        @else
                            {!! Form::label('staff', 'Staff Position') !!}
                            {!! Form::select('staff', [
                                0 => 'NONE',
                                1 => 'ATM',
                                2 => 'DATM',
                                3 => 'TA',
                                4 => 'ATA',
                                5 => 'WM',
                                6 => 'AWM',
                                7 => 'FE',
                                8 => 'AFE',
                                9 => 'EC',
                                10 => 'AEC'
                            ], $user->staff_position, ['class' => 'form-control']) !!}
                        @endif
                    </div>
                    @if($user->hasRole('mtr') || $user->hasRole('ins'))
                        <div class="col-sm-6">
                            {!! Form::label('train_pwr', 'Training Level') !!}
                            {!! Form::select('train_pwr', [
                                null => 'Not Able to Train',
                                1 => 'New Mentor',
                                2 => 'Minor Local',
                                3 => 'Major Local',
                                4 => 'Minor Approach',
                                5 => 'Major Approach',
                                6 => 'Center'
                            ], $user->train_pwr, ['class' => 'form-control']) !!}
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        @if($user->visitor == 1)
                            {!! Form::label('status', 'Status') !!}
                            {!! Form::select('status', [
                                1 => 'Active',
                                0 => 'LOA'
                            ], $user->status, ['class' => 'form-control', 'disabled']) !!}
                        @else
                            {!! Form::label('staff', 'Staff Position') !!}
                            {!! Form::select('staff', [
                                0 => 'NONE',
                                1 => 'ATM',
                                2 => 'DATM',
                                3 => 'TA',
                                4 => 'ATA',
                                5 => 'WM',
                                6 => 'AWM',
                                7 => 'FE',
                                8 => 'AFE',
                                9 => 'EC',
                                10 => 'AEC'
                            ], $user->staff_position, ['class' => 'form-control', 'disabled']) !!}
                        @endif
                    </div>
                    @if($user->hasRole('mtr') || $user->hasRole('ins'))
                        <div class="col-sm-6">
                            {!! Form::label('train_pwr', 'Training Level') !!}
                            {!! Form::select('train_pwr', [
                                null => 'Not Able to Train',
                                1 => 'New Mentor',
                                2 => 'Minor Local',
                                3 => 'Major Local',
                                4 => 'Minor Approach',
                                5 => 'Major Approach',
                                6 => 'Center'
                            ], $user->train_pwr, ['class' => 'form-control', 'disabled']) !!}
                        </div>
                    @endif
                </div>
            </div>
        @endif
        @if(Auth::user()->can('roster'))
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        @if($user->visitor == 1)
                            {!! Form::label('staff', 'Staff Position') !!}
                            {!! Form::select('staff', [
                                0 => 'NONE',
                                1 => 'ATM',
                                2 => 'DATM',
                                3 => 'TA',
                                4 => 'ATA',
                                5 => 'WM',
                                6 => 'AWM',
                                7 => 'FE',
                                8 => 'AFE',
                                9 => 'EC',
                                10 => 'AEC'
                            ], $user->staff_position, ['class' => 'form-control']) !!}
                        @else
                            {!! Form::label('training', 'Training Position') !!}
                            {!! Form::select('training', [
                                0 => 'NONE',
                                1 => 'MTR',
                                2 => 'INS'
                            ], $user->train_position, ['class' => 'form-control']) !!}
                        @endif
                    </div>
                    @if($user->hasRole('mtr') || $user->hasRole('ins'))
                        <div class="col-sm-6">
                            {!! Form::label('monitor_pwr', 'Monitoring Level') !!}
                            {!! Form::select('monitor_pwr', [
                                null => 'Not Able to Monitor',
                                1 => 'New Mentor',
                                2 => 'Minor Local',
                                3 => 'Major Local',
                                4 => 'Minor Approach',
                                5 => 'Major Approach',
                                6 => 'Center'
                            ], $user->monitor_pwr, ['class' => 'form-control']) !!}
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        @if($user->visitor == 1)
                            {!! Form::label('staff', 'Staff Position') !!}
                            {!! Form::select('staff', [
                                0 => 'NONE',
                                1 => 'ATM',
                                2 => 'DATM',
                                3 => 'TA',
                                4 => 'ATA',
                                5 => 'WM',
                                6 => 'AWM',
                                7 => 'FE',
                                8 => 'AFE',
                                9 => 'EC',
                                10 => 'AEC'
                            ], $user->staff_position, ['class' => 'form-control', 'disabled']) !!}
                        @else
                            {!! Form::label('training', 'Training Position') !!}
                            {!! Form::select('training', [
                                0 => 'NONE',
                                1 => 'MTR',
                                2 => 'INS'
                            ], $user->train_position, ['class' => 'form-control', 'disabled']) !!}
                        @endif
                    </div>
                    @if($user->hasRole('mtr') || $user->hasRole('ins'))
                        <div class="col-sm-6">
                            {!! Form::label('monitor_pwr', 'Monitoring Level') !!}
                            {!! Form::select('monitor_pwr', [
                                null => 'Not Able to Monitor',
                                1 => 'New Mentor',
                                2 => 'Minor Local',
                                3 => 'Major Local',
                                4 => 'Minor Approach',
                                5 => 'Major Approach',
                                6 => 'Center'
                            ], $user->monitor_pwr, ['class' => 'form-control', 'disabled']) !!}
                        </div>
                    @endif
                </div>
            </div>
        @endif
        @if(Auth::user()->can('roster'))
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        @if($user->visitor == 1)
                            {!! Form::label('training', 'Training Position') !!}
                            {!! Form::select('training', [
                                0 => 'NONE',
                                1 => 'MTR',
                                2 => 'INS'
                            ], $user->train_position, ['class' => 'form-control']) !!}
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        @if($user->visitor == 1)
                            {!! Form::label('training', 'Training Position') !!}
                            {!! Form::select('training', [
                                0 => 'NONE',
                                1 => 'MTR',
                                2 => 'INS'
                            ], $user->train_position, ['class' => 'form-control', 'disabled']) !!}
                        @endif
                    </div>
                </div>
            </div>
        @endif
        @if(Auth::user()->can('roster'))
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-10">
                        @if($user->canTrain == 1)
                            {!! Form::label('canTrain', 'Allow Training?') !!}
                            {!! Form::checkbox('canTrain', 1, true) !!}
                        @else
                            {!! Form::label('canTrain', 'Allow Training?') !!}
                            {!! Form::checkbox('canTrain', 1) !!}
                        @endif
                    </div>
                    <div class="col-sm-10">
                        @if($user->visitor == 1)
                            {!! Form::label('visitor', 'Visitor?') !!}
                            {!! Form::checkbox('visitor', 1, true) !!}
                            <a href="/dashboard/admin/roster/visit/remove/{{ $user->id }}">(Remove from Roster)</a>
                        @else
                            {!! Form::label('visitor', 'Visitor?') !!}
                            {!! Form::checkbox('visitor', 1) !!}
                        @endif
                    </div>
                    <div class="col-sm-10">
                        @if($user->canEvents == 1)
                            {!! Form::label('canEvents', 'Allow Signing up for Events?') !!}
                            {!! Form::checkbox('canEvents', 1, true) !!}
                        @else
                            {!! Form::label('canEvents', 'Allow Signing up for Events?') !!}
                            {!! Form::checkbox('canEvents', 1) !!}
                        @endif
                    </div>
                    @if($user->visitor != 1)
                        <div class="col-sm-10">
                            @if($user->api_exempt == 1)
                                {!! Form::label('api_exempt', 'Exempt from VATUSA API Roster Update?') !!}
                                {!! Form::checkbox('api_exempt', 1, true) !!}
                            @else
                                {!! Form::label('api_exempt', 'Exempt from VATUSA API Roster Update?') !!}
                                {!! Form::checkbox('api_exempt', 1) !!}
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-10">
                        @if($user->canTrain == 1)
                            {!! Form::label('canTrain', 'Allow Training?') !!}
                            {!! Form::checkbox('canTrain', 1, true, ['disabled']) !!}
                        @else
                            {!! Form::label('canTrain', 'Allow Training?') !!}
                            {!! Form::checkbox('canTrain', 1, null, ['disabled']) !!}
                        @endif
                    </div>
                    <div class="col-sm-10">
                        @if($user->visitor == 1)
                            {!! Form::label('visitor', 'Visitor?') !!}
                            {!! Form::checkbox('visitor', 1, true, ['disabled']) !!}
                        @else
                            {!! Form::label('visitor', 'Visitor?') !!}
                            {!! Form::checkbox('visitor', 1, null, ['disabled']) !!}
                        @endif
                    </div>
                    <div class="col-sm-10">
                        @if($user->canEvents == 1)
                            {!! Form::label('canEvents', 'Allow Signing up for Events?') !!}
                            {!! Form::checkbox('canEvents', 1, true, ['disabled']) !!}
                        @else
                            {!! Form::label('canEvents', 'Allow Signing up for Events?') !!}
                            {!! Form::checkbox('canEvents', 1, null, ['disabled']) !!}
                        @endif
                    </div>
                    @if($user->visitor != 1)
                        <div class="col-sm-10">
                            @if($user->api_exempt == 1)
                                {!! Form::label('api_exempt', 'Exempt from VATUSA API Roster Update?') !!}
                                {!! Form::checkbox('api_exempt', 1, true, ['disabled']) !!}
                            @else
                                {!! Form::label('api_exempt', 'Exempt from VATUSA API Roster Update?') !!}
                                {!! Form::checkbox('api_exempt', 1, null, ['disabled']) !!}
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        @endif
        <br>
        <div class="row">
            <div class="col-sm-1">
                <button class="btn btn-success" type="submit">Save</button>
            </div>
            {!! Form::close() !!}
            <div class="col-sm-1">
                <a href="/dashboard/controllers/roster" class="btn btn-danger">Cancel</a>
            </div>
        </div>
        <br>
        <hr>
        <div>
            <div>
                <center><h4>Training Tickets</h4></center>
                <div class="table">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">
                                <center>Date</center>
                            </th>
                            <th scope="col">
                                <center>Trainer</center>
                            </th>
                            <th scope="col">
                                <center>Position</center>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($tickets))
                            @foreach($tickets as $t)
                                <tr>
                                    <td>
                                        <center>
                                            <a href="/dashboard/training/tickets/view/{{ $t->id }}">{{ $t->date }}</a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>{{ $t->trainer_name }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $t->position_name }}</center>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    @if(!isset($tickets))
                        <p>No training tickets found.</p>
                    @endif
                </div>
                @if(isset($tickets))
                    {!! $tickets->links() !!}
                @endif
            </div>
            <div class="form-group">
                <form action="/dashboard/admin/logs/create/{{$user->id}}" method="POST">
                    @csrf
                    <label>Member Dossier</label>
                    <textarea class="form-control" required name="content"></textarea>
                    <br>
                    <button class="btn btn-primary" type="submit">Add Member Log</button>
                    &nbsp; &nbsp; &nbsp;
                    @if(Auth::user()->getStaffPositionAttribute() <= 3 && Auth::user()->getStaffPositionAttribute() > 0)
                        <input type="checkbox" class="form-check-input align-right" id="confidential" name="confidential">
                        <label class="form-check-label" for="confidential">Confidential</label>
                        <br/>
                    @endif
                </form>
            </div>
            <div>
                @if($user->getLogs() != null)
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Added By</th>
                            <th scope="col">Details</th>
                            <th scope="col">Confidential</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->getLogs() as $l)
                            <tr>
                                <td>
                                    @if($l->getAuthor() != null)
                                        {{$l->getAuthor()->first()->getFullNameAttribute()}}
                                    @else
                                        {{$l->user_submitter}}
                                    @endif
                                </td>
                                <td>
                                @if($l->confidential == 1 && (Auth::user()->getStaffPositionAttribute() <= 3 && Auth::user()->getStaffPositionAttribute() > 0))
                                    {{$l->content}}
                                @elseif($l->confidential == 1 && (Auth::user()->getStaffPositionAttribute() > 3 || Auth::user()->getStaffPositionAttribute() < 1))
                                    <i>***CONFIDENTIAL ENTRY***</i>
                                @else
                                    {{$l->content}}
                                @endif
                                </td>
                                <td>
                                    @if($l->confidential == 1)
                                        <i class="fas fa-check" style="color:green"></i>
                                    @else
                                        <i class="fas fa-times" style="color:red"></i>
                                    @endif
                                </td>
                                <td>
                                    {{$l->created_at->toDateString()}}
                                </td>
                                <td>
                                    <form action="/dashboard/admin/logs/delete/{{$l->id}}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
        <br>

    </div>
@endsection
