@extends('layouts.dashboard')

@section('title')
    Currency Center
@endsection

@section('content')
    <div class="container-fluid" style="background-color:#F0F0F0;">
        &nbsp;
        <h2>Currency Manager</h2>
        &nbsp;
    </div>
    <br>

    <div class="container">
        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#homewarnings" role="tab" data-toggle="tab" style="color:black">New LOA's</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#visitorwarnings" role="tab" data-toggle="tab" style="color:black">Active LOA's</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#homeremovals" role="tab" data-toggle="tab" style="color:black">Inactive LOA's</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#visitorremovals" role="tab" data-toggle="tab" style="color:black">Denied LOA's</a>
            </li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="homewarnings">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">CID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($homeWarnings) > 0)
                            @foreach($homeWarnings as $controller)
                                <tr>
                                    <td> {{$controller->id}} </td>
                                    <td> {{$controller->full_name}} </td>
                                    <td> {{$stats[$controller->id]}} </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">No controllers to display</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div role="tabpanel" class="tab-pane active" id="visitorwarnings">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">CID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($visitorWarnings) > 0)
                            @foreach($visitorWarnings as $controller)
                                <tr>
                                    <td> {{$controller->id}} </td>
                                    <td> {{$controller->full_name}} </td>
                                    <td> {{$stats[$controller->id]}} </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">No controllers to display</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div role="tabpanel" class="tab-pane active" id="homeremovals">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">CID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($homeRemovals) > 0)
                            @foreach($homeRemovals as $controller)
                                <tr>
                                    <td> {{$controller->controller_id}} </td>
                                    <td> {{$controller->controller_name}} </td>
                                    <td> {{$stats[$controller->controller_id]}} </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">No controllers to display</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div role="tabpanel" class="tab-pane active" id="visitorremovals">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">CID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($visitorRemovals) > 0)
                            @foreach($visitorRemovals as $controller)
                                <tr>
                                    <td> {{$controller->controller_id}} </td>
                                    <td> {{$controller->controller_name}} </td>
                                    <td> {{$stats[$controller->controller_id]}} </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">No controllers to display</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection