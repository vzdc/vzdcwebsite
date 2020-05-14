@extends('layouts.dashboard')

@section('title')
Request Exam
@endsection

@section('content')
<div class="container-fluid" style="background-color:#F0F0F0;">
    &nbsp;
    <h2>New Exam Request</h2>
    &nbsp;
</div>
<br>

<div class="container">
    <p>Use this form to request an exam be assigned for completion within the VATUSA exam center.</p>
    <hr />
    {{ Form::open(array('action' => 'TrainingDash@RequestExam')) }}
        @csrf
        {!! Form::label('name', 'Exam', ['class' => 'form-label']) !!}
        {{ Form::select('name', $exams, null, ['class' => 'form-control']) }}
        <br />
        <button action="submit" class="btn btn-success">Submit</button>
    {{ Form::close() }}
</div>
@endsection