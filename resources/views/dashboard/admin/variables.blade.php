@extends('layouts.dashboard')

@section('title')
    Website Variables
@endsection

@section('content')
<div class="container text-center">
    <hr />
    @if ($visitors->value == 1)
        <h4>Visitor applications currently <b>on</b></h4>
    @else
        <h4>Visitor applications currently <b>off</b></h4>
    @endif
    <h4>Last updated: {{ $visitors->updated_at }}</h4>
    <form action="/dashboard/admin/variables/updatevisitorsvariable" method="POST">
        @csrf
        <input type="checkbox" class="form-check-input align-right" id="visitors" name="visitors">
        <label class="form-check-label" for="visitors">Allow Visitors</label>
        <br />
        <button class="btn btn-primary" type="submit">Save Visitor Variable</button>
    </form>
    
    <br />
    <br />
    
    <form action="/dashboard/admin/variables/updatecurrencyvariable" method="POST">
        @csrf
        <textarea class="form-control" name="currency"></textarea>
        <!--<input type="text" class="form-check-input align-right" id="currency" name="currency">-->
        <label class="form-check-label" for="currency">Set Currency Hours</label>
        <br />
        <button class="btn btn-primary" type="submit">Save Currency Variable</button>
    </form>
    <hr />
</div>
@endsection