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
    <form action="/dashboard/training/exam/request" method="POST">
        @csrf
        <div class="form-group">
            <label for="exams">Select Exam</label>
            <select class="form-control" id="exams">
                <option>Washington Basic</option>
                <option>Washington S2 Knowledge</option>
                <option>Washington S2 Major Facilities</option>
                <option>Washington S3 Knowledge</option>
                <option>Washington S3 Chesapeake (CHP)</option>
                <option>Washington S3 Mount Vernon (MTV)</option>
                <option>Washington S3 Shenandoah (SHD)</option>
                <option>Washington C1 Knowledge</option>
            </select>
        </div>
        <br /><br />
        <button class="btn btn-primary" type="submit">Save Visitor Variable</button>
    </form>
</div>
@endsection