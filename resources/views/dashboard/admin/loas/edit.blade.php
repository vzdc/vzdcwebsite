@extends('layouts.dashboard')

@section('title')
    Edit LOA
@endsection

@section('content')

<div class="container-fluid" style="background-color:#F0F0F0;">
    <br />
    <h2>Edit LOA</h2>
    <br />
</div>

<br />

<div class="container">
    {!! Form::open(['action' => ['Admindash@UpdateLoa', $loa->id]]) !!}
    @csrf
    <div class="form-group">
        
    </div>
</div>

@endsection