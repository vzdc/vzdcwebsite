@extends('layouts.dashboard')

@section('title')
Currency Manager
@endsection

@section('content')
<div class="container">
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
            <table class="table table-bordered table-striped">
                <thead>
                    <th scope="col" colspan=5 class="text-center">Total Hours this Month</th>
                </thead>
                <thead>
                    <th scope="col" colspan=5 class="text-center">{{ number_format($all_stats['month'], 2) }}</th>
                </thead>
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Total This Month</th>
                        <th scope="col">Join Date</th>
                        <th scope="col">Last training</th>
                        <th scope="col">Activity Warning</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($controllers as $controller)
                        @if($stats[$controller->id]->total_hrs < 2)
                            <tr>
                                <td>{{ $controller->full_name }}</td>
                                <td>{{ $controller->rating_short }}</td>
                                <td>{{ $stats[$controller->id]->total_hrs }}</td>
                                <td>{{ $controller->added_to_facility }}</td>
                                <td>{{ $controller->getLastTrainingAttribute() }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection