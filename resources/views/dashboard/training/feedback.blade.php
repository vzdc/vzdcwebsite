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
        <form method="get" href="/dashboard/training/feedback/view">
            <div class="form-group">
                <label for="id">Select Controller</label>
                <select class="form-control" id="id">
                    @foreach($controller in $controllers)
                        <option value="{{ $controller->id }}">{{ $controller->backwards_name_with_cid }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</div>