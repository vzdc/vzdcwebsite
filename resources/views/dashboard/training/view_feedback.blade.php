@extends('layouts.dashboard')

@section('title')
View Feedback
@endsection

@section('content')
<div class="container-fluid" style="background-color:#F0F0F0;">
    &nbsp;
    <h2>Feedback - {{ $controller->full_name }}</h2>
    &nbsp;
</div>

<div class="container">
    @if ($feedback->count() > 0)
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
    @else
    <h5 class="text-center">No feedback to display.</h5>
    @endif
</div>