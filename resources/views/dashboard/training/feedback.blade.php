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
    <br><br>
    <h5>Search Feedback:</h5>
    {!! Form::open(['url' => '/dashboard/training/feedback/search']) !!}
        <div class="row">
            <div class="col-sm-3">
                {!! Form::text('cid', null, ['placeholder' => 'Search by CID', 'class' => 'form-control']) !!}
            </div>
            <div class="col-sm-1">
                <button class="btn btn-primary" action="submit">Search</button>
            </div>
            <div class="col-sm-1">
    {!! Form::close() !!}
    <center>OR</center>
    {!! Form::open(['url' => '/dashboard/training/feedback/search']) !!}
            </div>
            <div class="col-sm-3">
                {!! Form::select('cid', $controllers, null, ['placeholder' => 'Select Controller', 'class' => 'form-control']) !!}
            </div>
            <div class="col-sm-1">
                <button class="btn btn-primary" action="submit">Search</button>
            </div>
        </div>
    {!! Form::close() !!}

    @if($result != null)
        <hr>
        <h5 class="text-center">Showing Feedback for {{ $result->full_name }} ({{ $result->id }})</h5>
        <br>

        <table class="table table-responsive-sm">
            <thead>
                <tr>
                    <th scope="col">Position</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Submitted</th>
                    <th scope="col">Contacted</th>
                </tr>
            </thead>
            <tbody>
                @foreach($feedback as $f)
                <tr>
                    <td><b>{{ $f->position }}</b> ({{ $f->service_level_text }})</td>
                    <td data-toggle="tooltip" title="{{ $f->comments }}">{{ str_limit($f->comments, 80, '...') }}
                    </td>
                    <td>{{ $f->created_at }}</td>
                    <td>
                        @if($f->contacted == 1)
                            <i class="fas fa-check text-center" style="color:green"></i>
                        @else
                            <i class="fas fa-times text-center" style="color:red"></i>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection