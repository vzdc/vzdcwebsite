@extends('layouts.dashboard')

@section('title')
    Website Variables
@endsection

@section('content')
<div class="container text-center">
    <hr />
    @if ($visitors->value == 1)
        <h4>Visitor applications: <b>on</b></h4>
    @else
        <h4>Visitor applications: <b>off</b></h4>
    @endif
    <h4>Last updated: {{ $visitors->updated_at }}</h4>
    <hr />
    <br />

    <form action="/dashboard/admin/variables/updatevisitorsvariable" method="POST">
        @csrf
        <input type="checkbox" class="form-check-input align-right" id="visitors" name="visitors">
        <label for="visitors">Allow Visitors</label>
        <br /><br />
        <button class="btn btn-primary" type="submit">Save Visitor Variable</button>
    </form>
    
    <br />
    <br />

    <hr />
    <h4>Current currency requirement: <b>{{ $currency->value }}</b></h4>
    <h4>Last updated: {{ $currency->updated_at }}</h4>
    <hr />
    <br />

    <form action="/dashboard/admin/variables/updatecurrencyvariable" method="POST">
        @csrf
        <textarea class="form-control" name="currency"></textarea>
        <label for="currency">Set Currency Hours</label>
        <br /><br />
        <button class="btn btn-primary" type="submit">Save Currency Variable</button>
    </form>
    <hr />
</div>
@endsection