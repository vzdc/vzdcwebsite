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
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" placeholder="{{ $loa->controller_name }}" readonly>
            </div>
            <div class="col-sm-4">
                <label for="end_date" class="form-label">End Date</label>
                <input type="text" class="form-control" id="end_date" placeholder="{{ $loa->end_date }}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="form-label text-center">Reason</label>
            <textarea type="text" class="form-control" id="reason" placeholder="{{ $loa->reason }}" readonly></textarea>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('status', 'Update LOA Status') !!}
        {!! Form::select('status', array(1 => 'Approve', -1 => 'Deny'), 1) !!}
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