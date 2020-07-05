@extends('layouts.dashboard')

@section('title')
    LOA Center
@endsection

@section('content')
<div class="container-fluid" style="background-color:#F0F0F0;">
    &nbsp;
    <h2>LOA Management</h2>
    &nbsp;
</div>
<br>

<div class="container">
    <ul class="nav nav-tabs nav-justified" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="#new" role="tab" data-toggle="tab" style="color:black">New LOA's</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#active" role="tab" data-toggle="tab" style="color:black">Active LOA's</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#inactive" role="tab" data-toggle="tab" style="color:black">Inactive LOA's</a>
        </li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="new">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Controller</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Requested At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($pending->length > 0)
                        @foreach ($pending as $loa)
                            <td>{{$loa->controller_name}}</td>
                            <td>{{$loa->end_date}}</td>
                            <td>{{$loa->created_at}}</td>
                            <td>
                                <a class="btn btn-warning simple-tooltip"
                                    href="/dashboard/admin/loas/view/{{ $loa->id }}" data-toggle="tooltip"
                                    title="View LOA"><i class="fas fa-eye"></i></a>
                            </td>
                        @endforeach
                    @else
                        <td colspan="3">No pending LOA's</td>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="active">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Controller</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Requested At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($active->length > 0)
                        @foreach ($active as $loa)
                            <td>{{$loa->controller_name}}</td>
                            <td>{{$loa->end_date}}</td>
                            <td>{{$loa->created_at}}</td>
                            <td>
                                <a class="btn btn-warning simple-tooltip"
                                    href="/dashboard/admin/loas/view/{{ $loa->id }}" data-toggle="tooltip"
                                    title="View LOA"><i class="fas fa-eye"></i></a>
                            </td>
                        @endforeach
                    @else
                        <td colspan="3">No active LOA's</td>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="inactive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Controller</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Requested At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($inactive->length > 0)
                        @foreach ($inactive as $loa)
                            <td>{{$loa->controller_name}}</td>
                            <td>{{$loa->end_date}}</td>
                            <td>{{$loa->created_at}}</td>
                            <td>
                                <a class="btn btn-warning simple-tooltip"
                                    href="/dashboard/admin/loas/view/{{ $loa->id }}" data-toggle="tooltip"
                                    title="View LOA"><i class="fas fa-eye"></i></a>
                            </td>
                        @endforeach
                    @else
                        <td colspan="3">No inactive LOA's</td>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection