@extends('layouts.dashboard')

@section('title')
Dossier Entries
@endsection

@section('content')
<div class="container-fluid" style="background-color:#F0F0F0;">
    &nbsp;
    <h2>Dossier Entries</h2>
    &nbsp;
</div>
<br>

<div class="container">
    @if($search_result != null)
        <a class="btn btn-primary" href="/dashboard/training/tickets/new?id={{ $search_result->id }}">Submit New Training Ticket</a>
    @else
        <a class="btn btn-primary" href="/dashboard/training/tickets/new">Submit New Training Ticket</a>
    @endif
    <br><br>
    <h5>Search Dossier Entries:</h5>
    {!! Form::open(['url' => '/dashboard/admin/dossier/search']) !!}
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
    {!! Form::open(['url' => '/dashboard/admin/dossier/search']) !!}
            </div>
            <div class="col-sm-3">
                {!! Form::select('cid', $controllers, null, ['placeholder' => 'Select Controller', 'class' => 'form-control']) !!}
            </div>
            <div class="col-sm-1">
                <button class="btn btn-primary" action="submit">Search</button>
            </div>
        </div>
    {!! Form::close() !!}

    @if($search_result != null)
        <hr>
        <h5>Showing Dossier Entries for {{ $search_result->full_name }} ({{ $search_result->id }})</h5>
        <br>
        <table class="table">
            <thead>
                <tr>
                                    <th scope="col">Added By</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                </tr>
                @if($tickets->count() > 0)
                    @foreach($tickets as $t)
                        <tr>
                            <td><a href="/dashboard/training/tickets/view/{{ $t->id }}">{{ $t->date }}</a></td>
                            <td>{{ $t->trainer_name }}</td>
                            <td>{{ $t->facility_name }} {{ $t->position_name }}</td>
                            <td>{{ $t->type_name }}</td>
                            <td>{{ $t->start_time }}z</td>
                            <td>{{ $t->end_time }}z</td>
                            <td>@if($t->no_show == '1') <i class="fas fa-check" style="color:red"></i>@endif</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">No Dossier on file.</td>
                    </tr>
                @endif
            </thead>
        </table>
        {!! $tickets->appends(['id' => $search_result->id])->render() !!}
    @endif
</div>

@endsection
