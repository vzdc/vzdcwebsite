@extends('layouts.dashboard')

@section('title')
Dossier Entry
@endsection

@section('content')
<div class="container text-center">
    <br />

    <h5>Dossier Manual Entry</h5>
    <br />
    <div class="form-group">
        <form action="/dashboard/admin/logs/manual" method="POST">
            @csrf
            <textarea class="form-control" placeholder="Content..." required name="content"></textarea>
            <br>
            <button class="btn btn-primary" type="submit">Add Member Log</button>
            &nbsp; &nbsp; &nbsp;
            @if(Auth::user()->getStaffPositionAttribute() <= 3) <input type="checkbox" class="form-check-input align-right" id="confidential" name="confidential">
                <label class="form-check-label" for="confidential">Confidential</label>
                <br />
                @endif
        </form>
    </div>
</div>
@endsection