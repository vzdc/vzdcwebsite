@extends('layouts.dashboard')

@section('title')
    Website Variables
@endsection

@section('content')
<form action="/dashboard/admin/updatevisitorsvariable" method="POST">
    <input type="checkbox" class="form-check-input align-right" id="visitors" name="visitors">
    <label class="form-check-label" for="visitors">Allow Visitors</label>
    <button class="btn btn-primary" type="submit">Save Visitor Variable</button>
</form>

<hr />

<form action="/dashboard/admin/updatecurrencyvariable" method="POST">
    <input type="text" class="form-check-input align-right" id="currency" name="currency">
    <label class="form-check-label" for="currency">Set Currency Hours</label>
    <button class="btn btn-primary" type="submit">Save Currency Variable</button>
</form>
@endsection