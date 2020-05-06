@extends('layouts.dashboard')

@section('title')
Currency Manager
@endsection

@section('content')
<div class="container-fluid">
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
                    </tr>
                </thead>
                <tbody>
                    @for($i = 0; $i < count($controllers); $i++) @if($stats[$controllers[$i]->id]->total_hrs < 2) <tr>
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
</div>
@endsection