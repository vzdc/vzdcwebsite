@extends('layouts.master')

@section('title')
Visit
@endsection

@section('content')
<span class="border border-light" style="background-color:#F0F0F0">
    <div class="container">
        &nbsp;
        <h2>Visit ZDC ARTCC</h2>
        &nbsp;
    </div>
</span>
<br>

<div class="container">
    @if($allow == 1)
    {!! Form::open(['action' => 'FrontController@storeVisit']) !!}
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::label('cid', 'CID') !!}
                    {!! Form::text('cid', null, ['placeholder' => 'Required', 'class' => 'form-control']) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::label('name', 'Full Name') !!}
                    {!! Form::text('name', null, ['placeholder' => 'Required', 'class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', null, ['placeholder' => 'Required', 'class' => 'form-control']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('rating', 'Rating') !!}
                    {!! Form::select('rating', [
                        1 => 'Observer (OBS)', 2 => 'Student 1 (S1)',
                        3 => 'Student 2 (S2)', 4 => 'Senior Student (S3)',
                        5 => 'Controller (C1)', 7 => 'Senior Controller (C3)',
                        8 => 'Instructor (I1)', 10 => 'Senior Instructor (I3)',
                        11 => 'Supervisor (SUP)'
                    ], null, ['placeholder' => 'Select Rating', 'class' => 'form-control']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::label('home', 'Home ARTCC') !!}
                    {!! Form::text('home', null, ['placeholder' => 'Required', 'class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('reason', 'Explanation of Why You Want to Visit the ZDC ARTCC') !!}
            {!! Form::textArea('reason', null, ['placeholder' => 'Required', 'class' => 'form-control']) !!}
        </div>
        <div class="g-recaptcha" data-sitekey="6LcdaeMUAAAAAPegraMiMUtBu4ARKuLcbMHVcHQp"></div>
        <br>
        <button class="btn btn-success" type="submit">Submit</button>
    {!! Form::close() !!}
    @else
    <span class="border border-light text-center" style="background-color:#F0F0F0">
        <div class="container">
            &nbsp;
            <h4>Visitation of ZDC has been disabled per VATUSA Policy GO41520</h4>
            <a href="https://www.vatusa.net/docs/GO-41520.pdf">View Policy</a>
            &nbsp;
        </div>
    </span>
    @endif
</div>
@endsection
