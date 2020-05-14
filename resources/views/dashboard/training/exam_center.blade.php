@extends('layouts.dashboard')

@section('title')
Exam Center
@endsection

@section('content')
<div class="container-fluid" style="background-color:#F0F0F0;">
    &nbsp;
    <h2>Exam Center</h2>
    &nbsp;
</div>
<br>
<div class="container">
    <ul class="nav nav-tabs nav-justified" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="#new" role="tab" data-toggle="tab" style="color:black">Pending Requests</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#archive" role="tab" data-toggle="tab" style="color:black">Accepted Requests</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#archive" role="tab" data-toggle="tab" style="color:black">Assigned Requests</a>
        </li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="new">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Student</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Exam Requested</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($pending) > 0)
                    @foreach($pending as $entry)
                    <tr>
                        <td>{{ $entry->student_name }}</td>
                        <td>{{ $entry->reporter_name }}</td>
                        <td>{{ $entry->exam_name }}</td>
                        <td>
                            <a class="btn btn-success simple-tooltip"
                                href="/dashboard/training/exams/accept/{{ $entry->id }}" data-toggle="tooltip"
                                title="Accept Exam Request"><i class="fas fa-check"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <p>No pending exam requests.</p>
                    @endif
                </tbody>
            </table>
        </div>

        <div role="tabpanel" class="tab-pane" id="archive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Student</th>
                        <th scope="col">Instructor</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Exam Requested</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($accepted) > 0)
                    @foreach($accepted as $entry)
                    <tr>
                        <td>{{ $entry->student_name }}</td>
                        <td>{{ $entry->instructor_name }}</td>
                        <td>{{ $entry->student_rating }}</td>
                        <td>{{ $entry->exam_name}}</td>
                        <td>
                            <a class="btn btn-success simple-tooltip"
                                href="/dashboard/training/exams/assign/{{ $entry->id }}" data-toggle="tooltip"
                                title="Assign Exam Request"><i class="fas fa-check"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <p>No accepted exam requests.</p>
                    @endif
                </tbody>
            </table>
        </div>

        <div role="tabpanel" class="tab-pane" id="archive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Student</th>
                        <th scope="col">Instructor</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Exam Requested</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($assigned) > 0)
                    @foreach($assigned as $entry)
                    <tr>
                        <td>{{ $entry->student_name }}</td>
                        <td>{{ $entry->instructor_name }}</td>
                        <td>{{ $entry->student_rating }}</td>
                        <td>{{ $entry->exam_name}}</td>
                        <td>
                            <a class="btn btn-danger simple-tooltip"
                                href="/dashboard/training/exams/delete/{{ $entry->id }}" data-toggle="tooltip"
                                title="Delete Exam Assignment"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <p>No assigned exam requests.</p>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection