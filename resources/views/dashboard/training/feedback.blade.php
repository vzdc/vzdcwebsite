@extends('layouts.dashboard')

@section('title')
Feedback
@endsection

@section('content')
<div class="container-fluid" style="background-color:#F0F0F0;">
    &nbsp;
    <h2>Feedback</h2>
    &nbsp;
</div>

<br>

<div class="container">
    <div class="row">
        {!! Form::open(['url' => '/dashboard/training/feedback/view']) !!}
            <div class="col-sm">
                {!! Form::select('cid', $controllers, null, ['placeholder' => 'Select Controller', 'class' => 'form-control']) !!}
            </div>
            <div class="col-sm-1">
                <button class="btn btn-primary" action="submit">Search</button>
            </div>
        </div>
    {!! Form::close() !!}
    </div>
</div>