@extends('layouts.dashboard')

@section('title')
    Website Variables
@endsection

@section('content')
<div class="container text-center">
    <hr />
    <form action="/dashboard/admin/updatevisitorsvariable" method="POST">
        @csrf
        <input type="checkbox" class="form-check-input align-right" id="visitors" name="visitors">
        <label class="form-check-label" for="visitors">Allow Visitors</label>
        <br />
        <button class="btn btn-primary" type="submit">Save Visitor Variable</button>
    </form>
    
    <br />
    <br />
    
    <form action="/dashboard/admin/updatecurrencyvariable" method="POST">
        @csrf
        <input type="text" class="form-check-input align-right" id="currency" name="currency">
        <label class="form-check-label" for="currency">Set Currency Hours</label>
        <br />
        <button class="btn btn-primary" type="submit">Save Currency Variable</button>
    </form>
    <hr />
</div>
@endsection