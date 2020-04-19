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
   <!-- @if($search_result != null)
        <a class="btn btn-primary" href="/dashboard/training/tickets/new?id={{ $search_result->id }}">Submit New Training Ticket</a>
    @else
     <a class="btn btn-primary" href="/dashboard/training/tickets/new">Submit New Training Ticket</a>
    @endif -->
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

    <br />

    <h5>Dossier Manual Entry</h5>
    <br />
    <div class="form-group">
        <form action="/dashboard/admin/logs/manual" method="POST">
            @csrf
            <input class="form-control" type="text" placeholder="CID" required name="cid"></input>
            <br />
            <textarea class="form-control" placeholder="Content..." required name="content"></textarea>
            <br>
            <button class="btn btn-primary" type="submit">Add Member Log</button>
                &nbsp; &nbsp; &nbsp;
            @if(Auth::user()->getStaffPositionAttribute() <= 3)
                <input type="checkbox" class="form-check-input align-right" id="confidential" name="confidential">
                <label class="form-check-label" for="confidential">Confidential</label>
                <br />
            @endif
        </form>
    </div>

    @if($search_result != null)
        <hr>
        <h5>Showing Dossier Entries for {{ $search_result->full_name }} ({{ $search_result->id }})</h5>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Added By</th>
                    <th scope="col">Details</th>
                    <th scope="col">Confidential</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
                @if($tickets->count() > 0)
                    @foreach($tickets as $t)
                        <tr>
                            <td>
                                @if($t->getAuthor() != null)
                                    {{$t->getAuthor()->first()->getFullNameAttribute()}}
                                @else
                                    {{$t->user_submitter}}
                                @endif
                            </td>
                            <td>
                                @if($t->confidential == 1 && Auth::user()->getStaffPositionAttribute() <= 3)
                                    {{$t->content}}
                                @elseif($t->confidential == 1 && Auth::user()->getStaffPositionAttribute() > 3)
                                    <i>***CONFIDENTIAL ENTRY***</i>
                                @else
                                    {{$t->content}}
                                @endif
                            </td>
                            <td>
                                @if($t->confidential == 1)
                                    <i class="fas fa-check" style="color:green"></i>
                                @else
                                    <i class="fas fa-times" style="color:red"></i>
                                @endif
                            </td>
                            <td>{{ $t->created_at }}</td>
                            <td>
                                <form action="/dashboard/admin/logs/delete/{{$t->id}}" method="POST">
                                @csrf
                                <button class="btn btn-danger" type="submit">Remove</button>
                                </form>
                            </td>
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
