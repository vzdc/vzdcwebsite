@extends('layouts.dashboard')

@section('title')
New Training Ticket
@endsection

@section('content')
<div class="container-fluid" style="background-color:#F0F0F0;">
    &nbsp;
    <h2>Submit New Training Ticket</h2>
    &nbsp;
</div>
<br>
                <center><h5>Zulu/UTC Time Now:</h5></center>
                <center><iframe style="pointer-events: none" src="https://freesecure.timeanddate.com/clock/i6hnccu7/fs16/tct/pct/bas6/bat6/bac777/pa8/tt0/tm2/th1/ta1/tb4" frameborder="0" width="200" height="64" allowTransparency="true"></iframe></center>
<div class="container">
    {!! Form::open(['action' => 'TrainingDash@saveNewTicket']) !!}
        @csrf
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('controller', 'Controller', ['class' => 'form-label']) !!}
                    @if($c != null)
                        {!! Form::select('controller', $controllers, $c, ['placeholder' => 'Select Controller', 'class' => 'form-control']) !!}
                    @else
                        {!! Form::select('controller', $controllers, null, ['placeholder' => 'Select Controller', 'class' => 'form-control']) !!}
                    @endif
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    {!! Form::label('position', 'Position', ['class' => 'form-label']) !!}
                    {!! Form::select('position', [
                        0 => 'Delivery/Ground',
                        1 => 'Tower',
                        2 => 'TRACON',
                        3 => 'Center'
                    ], null, ['placeholder' => 'Select Position', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    {!! Form::label('facility', 'Facility', ['class' => 'form-label']) !!}
                    {!! Form::select('facility', [
                        0 => 'KIAD',
                        1 => 'KBWI',
                        2 => 'KDCA',
                        3 => 'KORF',
                        4 => 'ZDC'
                    ], null, ['placeholder' => 'Select Facility', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    @if(Auth::user()->hasRole('ins'))
                        {!! Form::label('type', 'Session Type', ['class' => 'form-label']) !!}
                        {!! Form::select('type', [
                            0 => 'Classroom Training',
                            1 => 'Sweatbox Training',
                            2 => 'Live Training',
                            3 => 'Live Monitoring',
                            4 => 'Sweatbox OTS (Pass)',
                            5 => 'Live OTS (Pass)',
                            6 => 'Sweatbox OTS (Fail)',
                            7 => 'Live OTS (Fail)'
                        ], null, ['placeholder' => 'Select Position', 'class' => 'form-control']) !!}
                    @else
                        {!! Form::label('type', 'Session Type', ['class' => 'form-label']) !!}
                        {!! Form::select('type', [
                            0 => 'Classroom Training',
                            1 => 'Sweatbox Training',
                            2 => 'Live Training',
                            3 => 'Live Monitoring'
                        ], null, ['placeholder' => 'Select Session Type', 'class' => 'form-control']) !!}
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('date', 'Date', ['class' => 'form-label']) !!}
                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                        {!! Form::text('date', null, ['placeholder' => 'MM/DD/YYYY', 'class' => 'form-control datetimepicker-input', 'data-target' => '#datetimepicker1']) !!}
                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('start', 'Start Time in Zulu', ['class' => 'form-label']) !!}
                    <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                        {!! Form::text('start', null, ['placeholder' => '00:00', 'class' => 'form-control datetimepicker-input', 'data-target' => '#datetimepicker2']) !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('end', 'End Time in Zulu', ['class' => 'form-label']) !!}
                    <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                        {!! Form::text('end', null, ['placeholder' => '00:00', 'class' => 'form-control datetimepicker-input', 'data-target' => '#datetimepicker3']) !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('duration', 'Duration (HH:mm)', ['class' => 'form-label']) !!}
                    <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                        {!! Form::text('duration', null, ['placeholder' => '00:00', 'class' => 'form-control datetimepicker-input', 'data-target' => '#datetimepicker4']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('comments', 'Comments (Visible to Controller and other Trainers)', ['class' => 'form-label']) !!}
                    {!! Form::textArea('comments', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('trainer_comments', 'Trainer Comments (Visible to Only Other Trainers)', ['class' => 'form-label']) !!}
                    {!! Form::textArea('trainer_comments', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        {!! Form::label('ots', 'Recommend for OTS?', ['class' => 'form-label']) !!}
        {!! Form::checkBox('ots', '1') !!}
        {!! Form::label('no_show', 'Mark Session as No-Show?', ['class' => 'form-label']) !!}
        {!! Form::checkBox('no_show', '1') !!}
        <br>
        <button class="btn btn-success" action="submit">Submit Ticket</button>
        <a href="/dashboard/training/tickets" class="btn btn-danger">Cancel</a>
    {!! Form::close() !!}
</div>

<script type="text/javascript">
$(function () {
    $('#datetimepicker1').datetimepicker({
        format: 'L'
    });
});

$(function () {
    $('#datetimepicker2').datetimepicker({
        format: 'HH:mm'
    });
});

$(function () {
    $('#datetimepicker3').datetimepicker({
        format: 'HH:mm'
    });
});

$(function () {
    $('#datetimepicker4').datetimepicker({
        format: 'HH:mm'
    });
});
</script>
<script>
    $(document).ready(function ($) {
        $('#timepicker').datetimepicker({
            format: 'hh:mm a'
        });
    });
</script>
@endsection
