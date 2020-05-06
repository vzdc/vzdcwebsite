@extends('layouts.dashboard')

@section('title')
Currency Manager
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <center>
                <h3>Total Hours this Month</h3>
            </center>
            <div class="card" style="background-color:#d3d3d3">
                <br>
                <center>
                    <h4>{{ number_format($all_stats['month'], 2) }}</h4>
                </center>
                <br>
            </div>
        </div>
    </div>
</div>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Total This Month</th>
                    <th scope="col">Join Date</th>
                    <th scope="col">Last training</th>
                </tr>
            </thead>
            <tbody>
                @for($i = 0; $i < count($controllers); $i++)
                    @if($controllers[$i]->total_hours < 2)
                        <tr>
                            <td>{{ $controllers[$i]->full_name }}</td>
                            <td>{{ $controllers[$i]->rating_short }}</td>
                            <td>{{ $stats[$controllers[$i]->id]->total_hrs }}</td>
                            <td>{{ $controllers[$i]->added_to_facility }}</td>
                            <td>{{ $controllers[$i]->getLastTrainingAttribute() }}</td>
                        </tr>
                    @endif
                @endfor
            </tbody>
        </table>
    </div>
</div>
@endsection