@extends('layouts.dashboard')

@section('title')
    Edit LOA
@endsection

@section('content')

<div class="container-fluid" style="background-color:#F0F0F0;">
    <br />
    <h2 class="text-center">Edit LOA</h2>
    <br />
</div>

<br />

<div class="container">
    {!! Form::open(['action' => ['AdminDash@UpdateLoa', $loa->id]]) !!}
    @csrf
    <div class="form-group">
        <div class="row">
            <div class="col-sm-4">
                {!! form::label('name', 'Name') !!}
                {!! form::text('name', $loa->controller_name, ['class' => 'form-control', 'placeholder' => $loa->controller_name, 'readonly' => 'true']) !!}
            </div>
            <div class="col-sm-4">
                {!! form::label('end_date', 'End Date') !!}
                {!! form::text('end_date', $loa->end_date, ['class' => 'form-control', 'placeholder' => $loa->end_date, 'readonly' => 'true']) !!}
            </div>
            <div class="col-sm-4">
                {!! form::label('email', 'Email') !!}
                {!! form::text('email', $loa->controller_email, ['class' => 'form-control', 'placeholder' => $loa->controller_email, 'readonly' => 'true']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! form::label('reason', 'Reason') !!}
            {!! form::textarea('reason', $loa->reason, ['class' => 'form-control', 'placeholder' => $loa->reason, 'readonly' => 'true']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('status', 'Update LOA Status') !!}
        {!! Form::select('status', array(1 => 'Approve', -1 => 'Deny', 3 => 'Manually End'), 1) !!}
    </div>
    <div class="form-group">
        {!! Form::label('reason', 'Reason for Denial (If Applicable)') !!}
        {!! Form::textArea('reason', null, ['class' => 'form-control']) !!}
    </div>
    <button class="btn btn-success" type="submit">Submit LOA</button>
        <a class="btn btn-danger" href="/dashboard/admin/loas">Cancel</a>
        {!! Form::close() !!}
</div>

@endsection